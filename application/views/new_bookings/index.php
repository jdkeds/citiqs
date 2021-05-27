<div class="row w-100 mt-2">
    <a class="ml-auto" href="javascript:;" onclick="displayView('tableView')"><i style="font-size: 26px"
            class="fa fa-bars text-dark mr-2"></i></a>
    <a href="javascript:;" onclick="displayView('calendarView')"><i style="font-size: 22px"
            class="fa fa-calendar text-dark mr-2"></i></a>
</div>
<div id="tableView" class="row w-100 mt-3 table-responsive agenda d-none">
    <table style="background: none !important;" class="table table-striped w-100 text-center">
        <tr>
            <th><?php echo $this->language->tLine('Reservation Name'); ?></th>
            <th><?php echo $this->language->tLine('Date'); ?></th>
        </tr>
        <?php foreach($agendas_calendar as $agenda): ?>
        <tr>
            <td>
                <a style="text-decoration: none;" class="text-dark"
                    href="<?php echo $agenda['spotLink']; ?>"><?php echo $agenda['eventName']; ?><a>
            </td>
            <td><?php echo date('Y-m-d', strtotime($agenda['dateTime'])); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
<div id="calendarView" class="row w-100 mt-2 agenda">
    <div class="cal-modal-container">
        <div style="width: 100%" class="cal-modal">
            <h3>UPCOMING EVENTS</h3>
            <div id="calendar">
                <div class="placeholder"></div>
                <div class="calendar-events"></div>
            </div>
        </div>
    </div>

</div>

<script>
const agendaList = '<?php echo json_encode($agendas_calendar); ?>';
</script>
<script src='https://cdn.jsdelivr.net/npm/flatpickr'></script>
	<script src="<?php echo $this->baseUrl; ?>assets/home/js/agendaCalendar.js"></script>
