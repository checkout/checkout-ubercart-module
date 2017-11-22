(function () {
  'use strict';

  var interval = 3000;
  var action = document.getElementById('cko-payment-action').getAttribute("name");
  var contextid = document.getElementById('order_id').value;

  function loadDoc() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState === 4 && this.status === 200) {
        setTimeout(loadDoc, interval);
        if (this.responseText === 'true') {
          location.reload();
        }
      }
    };
    xhttp.open('GET', '/?q=/uc_checkoutpayment/admin/' + action + '/' + contextid, true);
    xhttp.send();
  }

  if (action === 'capture' || action === 'refund' || action === 'cancel') {
    timeout = setTimeout(loadDoc, interval);
  }
}());
