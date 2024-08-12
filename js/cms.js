function pkg_status(thisval, urlData, id)
 {
	 $.ajax({
		 url:urlData+"?status="+thisval+"&id="+id,
		 success: function(data)
		 {
			 $("#"+id).load(redUrl+"?page="+page+"&pkg="+callDiv);
			 alert(data);
			/* if(thisval=='active'){
			 window.open('https://plus.google.com/share?url=http://toursvision.com/view_img.php?id='+id, 'sharer', 'toolbar=0,status=0,width=548,height=325');
			 window.open("http://www.facebook.com/sharer.php?u=http://toursvision.com/view_img.php?id="+id, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=400");
			 }*/
		 }
	 });
 }