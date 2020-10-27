
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
    <div class="container mt-3">
      <div class="row justify-content-center mt-3" >
        <form action="#" class="col-md-6 justify-content-center shadow p-5 mb-5 bg-white rounded mt-5 needs-validation" novalidate>
          <h3 class="text-muted text-center mb-3" >Calculator</h3>

          <div class="form-group text-left">
            <label for="">Amount : </label>
            <input class="form-control" type="number" id="amount" required placeholder="Amount of order"/>
            <!--<small class="form-text text-muted">Seu email não será compartilhado com ninguém</small>-->
          </div>

          <div class="form-group text-left">
            <label for="">Time : </label>
            <input class="form-control" type="number" id="time" required placeholder="Times per day"/>
          </div>

          <div class="form-group text-left">
            <label for="">Commission : </label>
            <input class="form-control required" type="number" min="1" max="100" id="commission" required="true" placeholder="Percentage for commission"/>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="costPerDay">Cost Per Day </label>
              <input type="text" class="form-control" id="costPerDay" value="" disabled>
            </div>
            <div class="form-group col-md-4">
              <label for=""> &nbsp </label>
              <input type="text" class="form-control" id="e" value="" disabled>
            </div>
            <div class="form-group col-md-4">
              <label for="">&nbsp </label>
              <input type="text" class="form-control" id="f" value="" disabled>
            </div>
          </div>

          <button class="btn  btn-outline-primary btn-block mt-4"  type="submit">Save</button>
        </form>
      </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
      $("#amount").on('change',function(){
        let amount = this.value;
        let time = $.isNumeric($("#time").val()) ? $("#time").val() : 1;
        let commission = $.isNumeric($("#commission").val()) ? $("#commission").val()/100 : 1;
        let costPerDay = (amount*time)*commission;
        let e = costPerDay*30;
        let f = e*12;
        costPerDay_formated = Number.isInteger(costPerDay) ? costPerDay : number_format(costPerDay, 2, '.', '');
        e_formated = Number.isInteger(e) ? e : number_format(e, 2, '.', '');
        f_formated = Number.isInteger(f) ? f : number_format(f, 2, '.', '');
        //console.log(costPerDay_formated);
        $("#costPerDay").val(costPerDay_formated);
        $("#e").val(e_formated);
        $("#f").val(f_formated);
      });
      
      $("#time").on('change',function(){
        let time = this.value;
        let amount = $.isNumeric($("#amount").val()) ? $("#amount").val() : 1;
        let commission = $.isNumeric($("#commission").val()) ? $("#commission").val()/100 : 1;
        let costPerDay = (amount*time)*commission;
        let e = costPerDay*30;
        let f = e*12;
        costPerDay_formated = Number.isInteger(costPerDay) ? costPerDay : number_format(costPerDay, 2, '.', '');
        e_formated = Number.isInteger(e) ? e : number_format(e, 2, '.', '');
        f_formated = Number.isInteger(f) ? f : number_format(f, 2, '.', '');
        //console.log(costPerDay_formated);
        $("#costPerDay").val(costPerDay_formated);
        $("#e").val(e_formated);
        $("#f").val(f_formated);
      });

      $("#commission").on('change',function(){
        let commission = this.value/100;
        let time = $.isNumeric($("#time").val()) ? $("#time").val() : 1;
        let amount = $.isNumeric($("#amount").val()) ? $("#amount").val() : 1;
        let costPerDay = (amount*time)*commission;
        let e = costPerDay*30;
        let f = e*12;
        costPerDay_formated = Number.isInteger(costPerDay) ? costPerDay : number_format(costPerDay, 2, '.', '');
        e_formated = Number.isInteger(e) ? e : number_format(e, 2, '.', '');
        f_formated = Number.isInteger(f) ? f : number_format(f, 2, '.', '');
        //console.log(costPerDay_formated);
        $("#costPerDay").val(costPerDay_formated);
        $("#e").val(e_formated);
        $("#f").val(f_formated);
      });

    });

    function number_format (number, decimals, dec_point, thousands_sep) {
      number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
      var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
          s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
          s[1] = s[1] || '';
          s[1] += new Array(prec - s[1].length + 1).join('0');
          }
        
        return s.join(dec);
    }

    </script>
    <script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        event.preventDefault();
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        } else {
          let amount = $("#amount").val();
          let times_per_day = $("#time").val();
          let commission = $("#commission").val();
          $.post("<?php echo base_url('marketing/calculator/saveCalc'); ?>", {amount: amount,times_per_day: times_per_day,commission: commission}, function(data){
            toastr["success"]("Saved successfully!");
            setTimeout(function(){ location.reload(); }, 2000);
          });
          event.preventDefault();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>