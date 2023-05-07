document.addEventListener('DOMContentLoaded', function () {
  console.log('Hello');
  var links = document.querySelectorAll('.delete');
  for (i = 0; i < links.length; i++) {
    links[i].addEventListener('click', function (e) {
      console.log('Hello 2');
      if (!confirm('Are You Sure?')) {
        e.preventDefault();
      }
    });
  }
});
