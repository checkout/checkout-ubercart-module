function showCKOEmbedModal (){
  var ckoLink = document.getElementById('order-pane-payment');
  var offsets = ckoLink.getBoundingClientRect();
  var top = offsets.top + offsets.height + 10;
  var left = offsets.left;

  var ckoPopup = document.getElementById('cko-paymentpopup');
  ckoPopup.classList.remove('hidden');
  ckoPopup.style.top = Math.round(top)+"px";
  ckoPopup.style.left = Math.round(left)+"px";
}

function hideCKOEmbedModal (){
  var ckoPopup = document.getElementById('cko-paymentpopup');
  ckoPopup.classList.add('hidden');
}

