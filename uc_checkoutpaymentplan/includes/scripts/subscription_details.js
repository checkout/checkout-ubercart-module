function ckoClose($element) {
  'use strict';
  var ckoPopup = document.getElementById($element);
  ckoPopup.classList.add('hidden');
}

function ckoRemoveSubscriptions($id) {
  'use strict';

  var elements = document.getElementsByClassName($id);

  for (var i = 0, len = elements.length; i < len; i++) {
    elements[i].classList.add('hidden');
  }
}