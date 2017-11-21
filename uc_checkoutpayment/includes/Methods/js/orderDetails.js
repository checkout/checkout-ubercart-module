window.onscroll = function(){
  ckoSetPanePosition();
};

function ckoShowPane (){
  var ckoPopup = document.getElementById('cko-paymentpopup');
  ckoPopup.classList.remove('hidden');
  
  document.getElementById("payment_card_token").value = "Progress";

  ckoSetPanePosition();
}

function ckoHidePane (){
  var ckoPopup = document.getElementById('cko-paymentpopup');
  ckoPopup.classList.add('hidden');
}

function ckoSetPanePosition() {
  var ckoPopup = document.getElementById('cko-paymentpopup');
  
  if (!ckoPopup.classList.contains('hidden')) {
    var ckoLink = document.getElementById('order-pane-payment');
    var offsets = ckoLink.getBoundingClientRect();
    var top = offsets.top + offsets.height + 13;
    var left = offsets.left;
  
    var offsetsPopup = ckoPopup.getBoundingClientRect();
  
    var offsetsWindow = document.body.getBoundingClientRect();
    if (offsets.left + offsets.width + offsetsPopup.width < offsetsWindow.width) {
      top -= offsets.height + 13;
      left += offsets.width + 13;
    }
  
    ckoPopup.style.top = Math.round(top)+"px";
    ckoPopup.style.left = Math.round(left)+"px";
  }
}

function ckoAddCardTokenToForm(token) {
  if (token.startsWith('card_tok_')) {
    document.getElementById("payment_card_token").value = token;

    var button = document.getElementById('pay-now-button');
    button.classList.add('hidden');

    var message = document.getElementById('cko-success');
    message.classList.remove('hidden');
  }
}
