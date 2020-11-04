      </div>
    </div>
    <script>
      $('.summernote').summernote({
        height: 100
      });

      $(document).ready(function(){
      var date_input=$('.date_input'); //our date input has the name "date"
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        format: 'dd/mm/yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
      };
      date_input.datepicker(options);
    })
    </script>
</body>
</html>