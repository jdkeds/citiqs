


$(document).ready(function () {


  var table = $("#vouchersend").DataTable({
    processing: true,
    lengthMenu: [
      [5, 10, 20, 50, 100, 200, 500, -1],
      [5, 10, 20, 50, 100, 200, 500, "All"],
    ],
    pageLength: 5,
    ajax: {
      type: "get",
      url: globalVariables.baseUrl + "customer_panel/get_reservations",
      dataSrc: "",
    },
    columns: [
      {
        title: "ID",
        data: "id",
      },
      {
        title: "Reservation ID",
        data: "reservationId",
      },
      {
        title: "Name",
        data: "name",
      },
      {
        title: "Email",
        data: "email",
      },
      {
        title: "Reservation Time",
        data: "reservationtime",
      },
      
      
    ],
    order: [[1, 'asc']]
  });

  $('#report_filter').addClass('text-right');
  $('#report_filter label').addClass('text-left');

});


function bookReservationForm() {
  $('#submitBookReservation').click();
}

function bookReservation(e){
  e.preventDefault();
  $('.form-control').removeClass('input-clear');
  if ($('.form-control:invalid').length > 0) {
    return;
  }
  let data = {
      name: $('#name').val(),
      email: encodeURI($('#email').val()),
      mobile: $('#mobile').val(),
      event_date: encodeURI($('#agendas option:selected').val()),
      agenda_id: $('#agendas option:selected').attr('data-agenda'),
      timeslot: $('#spots option:selected').val(),
      spot_id: $('#spots option:selected').val(),
      fromtime: encodeURI($('#timeslots option:selected').attr('data-fromtime')),
      totime: encodeURI($('#timeslots option:selected').attr('data-totime')),
      emailId: $('#email_template option:selected').val(),
      price: $('#amount').val(),
      timeslot_price: $('#timeslots option:selected').attr('data-price')
  }


  //console.log(data);

  $('#submitBookReservation').prop('disabled', true);

  $.post(globalVariables.baseUrl + "customer_panel/book_reservation", data, function(data){
      $('#vouchersend').DataTable().ajax.reload();
      $('#submitBookReservation').prop('disabled', false);
      $('#resetForm').click();
      $('#closeModal').click();
      $('.form-control').addClass('input-clear');
      var html = '<option value="">Select Option</option>';
      $('#spots').html(html);
      $('#timeslots').html(html);
      //alertify[data.status](data.message);

  });

}


function get_spots() {
  let agenda_id = $('#agendas option:selected').attr('data-agenda');
  $.post(globalVariables.baseUrl + "customer_panel/get_spots",{agenda_id: agenda_id},function (data) {
      let spots = JSON.parse(data);
      var html = '<option value="">Select option</option>';
      $.each(spots, function (index, spot) {
          html += '<option value="' + spot.spot_id + '" >' + spot.spot_descript + '</option>';
      });
      $('#spots').html(html);

    });
}

function get_timeslots() {
  let spot_id = $('#spots option:selected').val();
  $.post(globalVariables.baseUrl + "customer_panel/get_timeslots",{spot_id: spot_id},function (data) {
      let timeslots = JSON.parse(data);
      var html = '<option value="">Select option</option>';
      $.each(timeslots, function (index, timeslot) {
          html += '<option value="' + timeslot.timeslot_id + '" data-fromtime="'+ timeslot.fromtime + '" data-totime="'+ timeslot.totime + '" data-price="'+ timeslot.timeslot_price + '">' + timeslot.fromtime + ' - ' +timeslot.totime+'</option>';
      });
      $('#timeslots').html(html);

    });
}