$(document).ready(function(){
	$('#addBtn').click(function(){
		var codeName = $('#name').val();
		var blood = $('#blood').val();
		var antennas = $('#antennas').val();
		var legs = $('#legs').val();
		var planet = $('#planet').val();

		if(codeName == ''){
			$('.error').text('Please Enter Code Name.').show();
			return false;
		}

		if(blood == ''){
			$('.error').text('Please Enter Blood Color.').show();
			return false;
		}

		if(antennas == ''){
			$('.error').text('Please Enter Number of Antennas.').show();
			return false;
		}	
		
		if(legs == ''){
			$('.error').text('Please Enter Number of Legs.').show();
			return false;
		}		
		
		if(planet == ''){
			$('.error').text('Please Enter Home Planet.').show();
			return false;
		}
		
		$.ajax({
			url:'process.php'
			,type:'GET'
			,dataType:'json'
			,data:{
				type:'insert'
				,codeName:codeName
				,bloodColor:blood
				,antennas:antennas
				,legs:legs
				,homePlanet:planet
			}
			,success:function(resp){
				location.reload();
			}
		});
	});
	
	$('.word').click(function(){
		window.open('wordDoc.php');
	});
	
	$('.pdf').click(function(){
		window.open('processExport.php');
	});
});