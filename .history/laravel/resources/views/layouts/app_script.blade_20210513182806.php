<script>
  $(function() {
    $(".delete).click(function(){
      if(confirm("削除しますか？")) {
      //そのままsubmit（削除）
      } else {
      //cancel
      return false;
      }
    });
  });
</script>