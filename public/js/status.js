function changeStatus($selector){
    var $this=$selector;
    if($this.hasClass('label-success')){
        $this.removeClass('label-success').addClass('label-danger')
        .html('Inactive');
      }else{
        $this.removeClass('label-danger').addClass('label-success')
        .html('Active');
      }
}