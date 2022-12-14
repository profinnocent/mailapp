</body>
<script type="text/javascript" src="../assets/dist/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="../assets/dist/js/all.js"></script>
<script type="text/javascript" src="../assets/dist/js/bootstrap.bundle.js"></script>
<script type="text/javascript" src="../assets/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="../assets/dist/js/bootstrap.js"></script>
<script>
  $(function(){
    var imagepreview = function(input, placetoinsertimage){
      if(input.files){
        var fileamount = input.files.length;
        for(i = 0; i < fileamount; i++){
          var reader = new FileReader();

          reader.onload = function(event){
            $($.parseHTML('<embed width="20%" height="40%" >')).attr('src', event.target.result).appendTo(placetoinsertimage)
          }
          reader.readAsDataURL(input.files[i]);
        }
      }
    }
    $('#gallery-photo-add').on('change', function(){
      imagepreview(this, 'div.gallery');
    });
  });
</script>
</html>