

function time() {
  today = new Date();
  h = today.getHours().toString().padStart(2,'0');
  m = today.getMinutes().toString().padStart(2,'0');
  s = today.getSeconds().toString().padStart(2,'0');
  document.getElementById('txt').innerHTML = h + ":" + m + ":" + s;
  setTimeout('time()', 500);
}





