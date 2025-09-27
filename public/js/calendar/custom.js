$(function() {
  var start = moment().subtract(29, 'days');
  var end = moment();
  function cb(start, end) {
      $('#reportrange span').html(start.format('от DD.MM.YYYY') + '&nbsp;&nbsp;' + end.format('до DD.MM.YYYY'));
  }
  $('#reportrange').daterangepicker({
      startDate: start,
      endDate: end,
      ranges: {
         'Сегодня': [moment(), moment()],
         'Вчера': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
         'Последние 7 дней': [moment().subtract(6, 'days'), moment()],
         'Последние 30 дней': [moment().subtract(29, 'days'), moment()],
         'Этот месяц': [moment().startOf('month'), moment().endOf('month')],
         'Прошлый месяц': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      }
  }, cb);
  cb(start, end);
});
