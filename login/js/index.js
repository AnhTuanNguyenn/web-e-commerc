var cont = 0;

function register(){

     cont++;
		
		if(cont==1){
		 	$('.box').animate({height:'695px'}, 550);
			$('.show').css('display','block');
			$('#logintoregister').text('Register');
			$('#buttonlogintoregister').text('Register');
			$('#plogintoregister').text("Are you already registered?");
			$('#textchange').text('Accept');
		}
		else
		{
			$('.show').css('display','none');
			$('.box').animate({height:'365px'}, 550);
			$('#logintoregister').text('Login');
			$('#buttonlogintoregister').text('Login');
			$('#plogintoregister').text("Not registered?");
			$('#textchange').text('Sign in');
			cont = 0;
		}
}