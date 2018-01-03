$(window).load(function(){

	$(".order_now").bind("click",function(){
		var $thread_id = $(this).attr("thread_id");
		if($thread_id < 1)
		{
			alert("This Product is out of stock");
			return false;
		}
		
		$.post("administrator/ajax/ajax_cart.php",{action:"order",thread_id:$thread_id},function($data){
			alert($data.msg);
			if($data.code==1000)
			{
				$(".total_product").html($data.total+" items");
			}
			return false;
		},"json")
	})

	$(".buy_now").bind("click",function(){
		var $thread_id = $(this).attr("thread_id");
		if($thread_id < 1)
		{
			alert("This Product is out of stock");
			return false;
		}
		
		

		$.post("administrator/ajax/ajax_cart.php",{action:"order",thread_id:$thread_id},function($data){
			alert($data.msg);
			if($data.code==1000)
			{
				$(".total_product").html($data.total+" items");
				window.location.href = "thanh-toan-don-hang.html";
			}
			return false;
		},"json")
	})

	$(".prev_total").bind("click",function(){
		var $thread_id = $(this).parent().parent().attr("thread_id");

		var $total = parseInt($("#thread_id-"+$thread_id+" .total").html());
		$.post("administrator/ajax/ajax_cart.php",{action:"order",thread_id:$thread_id,type:"prev"},function($data){
			if($data.code==1000)
			{
				$("#thread_id-"+$thread_id+" .total").html(--$total);
			}
			return false;
		},"json")
	})

	$(".next_total").bind("click",function(){
		var $thread_id = $(this).parent().parent().attr("thread_id");
		var $total = parseInt($("#thread_id-"+$thread_id+" .total").html());
		$.post("administrator/ajax/ajax_cart.php",{action:"order",thread_id:$thread_id,type:"next"},function($data){
			if($data.code==1000)
			{
				$("#thread_id-"+$thread_id+" .total").html(++$total);
			}
			return false;
		},"json")
	})

	$(".chx_featured_product").bind("click",function(){
		var $thread_id = $(this).attr("thread_id");
		var $flag = 0; 
		if($(this).is(":checked"))
		{
			$flag = 1;
		} 
		$.post("ajax/ajax_thread.php",{action:"set_feature",flag:$flag,thread_id:$thread_id});
	})
	var supportCanvas = 'getContext' in document.createElement('canvas');

	var slides = $('#slideshow li'),
		current = 0,
		slideshow = {width:0,height:0};

	setTimeout(function(){
		
		window.console && window.console.time && console.time('Generated In');
		
		if(supportCanvas){
			$('#slideshow img').each(function(){

				if(!slideshow.width){
					// Taking the dimensions of the first image:
					slideshow.width = this.width;
					slideshow.height = this.height;
				}
				
				// Rendering the modified versions of the images:
				createCanvasOverlay(this);
			});
		}
		
		window.console && window.console.timeEnd && console.timeEnd('Generated In');
		
		$('#slideshow .arrow').click(function(){
			var li			= slides.eq(current),
				canvas		= li.find('canvas'),
				nextIndex	= 0;

			
			
			if($(this).hasClass('next')){
				nextIndex = current >= slides.length-1 ? 0 : current+1;
			}
			else {
				nextIndex = current <= 0 ? slides.length-1 : current-1;
			}

			var next = slides.eq(nextIndex);
			
			if(supportCanvas){



				canvas.fadeIn(function(){

					next.show();
					current = nextIndex;
					
					
					li.fadeOut(function(){
						li.removeClass('slideActive');
						canvas.hide();
						next.addClass('slideActive');
					});
				});
			}
			else {
				
				
				current=nextIndex;
				next.addClass('slideActive').show();
				li.removeClass('slideActive').hide();
			}
		});
		
	},100);
	
	function createCanvasOverlay(image){

		var canvas			= document.createElement('canvas'),
			canvasContext	= canvas.getContext("2d");
		
	
		canvas.width = slideshow.width;
		canvas.height = slideshow.height;
		
	
		canvasContext.drawImage(image,0,0);
		

		
		var imageData	= canvasContext.getImageData(0,0,canvas.width,canvas.height),
			data		= imageData.data;
		
		
		for(var i = 0,z=data.length;i<z;i++){
			
			
			
			data[i] = ((data[i] < 128) ? (2*data[i]*data[i] / 255) : (255 - 2 * (255 - data[i]) * (255 - data[i]) / 255));
			data[++i] = ((data[i] < 128) ? (2*data[i]*data[i] / 255) : (255 - 2 * (255 - data[i]) * (255 - data[i]) / 255));
			data[++i] = ((data[i] < 128) ? (2*data[i]*data[i] / 255) : (255 - 2 * (255 - data[i]) * (255 - data[i]) / 255));
			
		
			++i;
		}
		
		
		canvasContext.putImageData(imageData,0,0);

		image.parentNode.insertBefore(canvas,image);
	}
	
});
var cont = 0;

function register(){

     cont++;
		
		if(cont==1){
		 	$('.box').animate({height:'695px'}, 550);
			$('.show').css('display','block');
			$('#logintoregister').text('Registrati');
			$('#buttonlogintoregister').text('Registrati');
			$('#plogintoregister').text("Sei gia' registrato?");
			$('#textchange').text('Accedi');
		}
		else
		{
			$('.show').css('display','none');
			$('.box').animate({height:'365px'}, 550);
			$('#logintoregister').text('Login');
			$('#buttonlogintoregister').text('Login');
			$('#plogintoregister').text("Non sei iscritto?");
			$('#textchange').text('Registrati');
			cont = 0;
		}
}

