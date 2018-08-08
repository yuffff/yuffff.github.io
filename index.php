
<!DOCTYPE html>

<html>
<head>

<meta charset="utf-8">
<script src="http://code.jquery.com/jquery-latest.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=yes" /> 
</head>

<body background="1.png">
	<div id = "oben">
	<table border="1">
	<tr>
		<th colspan="2" valign="middle">Denken & Thema & Schreiben Zusammenfassung</th>
	</tr>
	</table>
	
	<table border="1">
		<tr>
			<td><div id="result"></div>
			<td><a href="#mtable">nach unten</a>
		</tr>
	</table>
	<table border="1">
		<tr>
			<td>Name des Dokumentes:<input id="fname"></input>
			    <br><br>Längenmaß des Dokumentes:<div id="lange"> </div>
			<td><button onclick="loadfile()">Load</button><br><br><button onclick="saveJson()">Save</button>
													<br><br><button onclick="myreload()">S&RELOAD</button>
													<br><br>
		</tr>
	</table>
	<table border="1">
		<tr>
			<td><a href="Schreiben/">Schreib</a>
			<td><a href="N/">Not</a>
			<td><a href="notiz/">Inhalte</a>
		</tr>
	</table>
	
	<br>
	<table border="1">
	
	<tr>
		<td width="98%" id="ywc01" colspan="2" >Leer</td> 
	</tr>
	
	</table><br>
	<a href="#oben">nach oben</a><br>
	<table border="1">
	<tr>
		<td colspan="1" valign="top">
		         Inhalte:<input id="addwc"></input><br>
				 <button onclick="addstate()">OK</button>
				 <br><br>
				 
		         Geben Sie die Zahl fur Tab ein:<input id="tabsize" size="1"></input>
		         <br>
				 <br><br>
				 
				 <button onclick="plus(1)">Zahl+</button>
				 <button onclick="plus(0)">Zahl-</button>
				 <br><br>
				 
				 Geben Sie die Zahl fur Insert ein:<input id="position" size="1"></input>
		        <br>
				<button onclick="plus(4)">Zahl+</button>
				 <button onclick="plus(3)">Zahl-</button>
				 <br><br>
				 
				 Geben Sie die Zahl fur Schieben ein:<br><input id="v1" size="1"></input>-<input id="v2" size="1"></input>-><input id="v3" size="1"></input>
				 <button onclick="excschi()">Excute</button>
				 <br><br>
				 
				 
				 
		<td colspan="1" valign="middle">
		    
			<button onclick="addwc(0)">ADD</button>
		<td colspan="1" valign="middle">
			<button onclick="delwc(0)">DEL</button>
	<tr>
		<td colspan="1" valign="bottom"><br>
			<button onclick="delwc(1)">LEER</button>
		<td colspan="1" valign="middle"><br>
			<button onclick="addwc(1)" >State++</button><br><br>
			<button onclick="addwc(2)" >TAB</button><br><br>
			<button onclick="saveJson()">S&Quit</button><br><br>
			<button onclick="myreload()">S&RELOAD</button>
		</td>
	</tr>
	</table><br>
	<table border="1">
	<tr>
		<th colspan="3" valign="middle">Zusatzliche Funktionen</th>
	</tr>
	
	<tr>
	
				<form action="jpg.php" method="post" enctype="multipart/form-data">
					<td colspan="1" valign="middle">
						Hyperlink erstellen(<2M):(Bilder,Unterlagen...)<input type="file" name="imgfile" ><br>
					</td>
					<td colspan="1" valign="middle">
						<input type="submit" name="submit" value="erstellen"><br>
					</td>
				</form>
	</tr>
	
	<tr>
	
		<td colspan="1" valign="bottom">
				Titel:<input id="linkInhalt"></input><br>
				URL:<input id="weblink"></input>
				
			</td>
			<td colspan="1" valign="middle">
				<button onclick="addlink()">Hyperlink senden</button><br>
		</td>
	</tr>
	</table>
	
	
	<div id = "state"></div>
	<div id = "mtable"></div>
	
</body>
<style type="text/css">
table
{
width: 100%
}
input
{
background-color:#808080
}
button{
background-color:#808080
} 
a{
	color: #efd123;
}
</style>
<?php 
	//header("content-type:text/html; charset=gb2312");
?>
<script type = "text/javascript">


	var filename = new Array();
	filename.push("default.json");
	var ywc = new Array();
	ywc.push("");
	var str= "";
	var daywc=0;
	document.getElementById("tabsize").value=0;

	function addwc(n){
		var today = new Date();

		 var month = today.getMonth()+1;
		 var day = today.getDate();
		 var tabsize= document.getElementById("tabsize").value;
                 var pos=document.getElementById("position").value;
		if(n==1){
			pos++;
			 ywc.splice(pos,0,"========"+str+"===<br>");
			//ywc.push("========++++++++++++++++++++========<br>");
			daywc++;
		}else if(n==0){
					pos++;
				    if(tabsize==1){
						ywc.splice(pos,0,">>>>\u25cf "+document.getElementById("addwc").value+"<br>");
							//"<label><input type='checkbox'>搁置</label> <label><input type='checkbox'>完成</label>");
					}else if(tabsize==2){
						ywc.splice(pos,0,">>>>>>>>\u25cf "+document.getElementById("addwc").value+"<br>");
							//"<label><input type='checkbox'>搁置</label> <label><input type='checkbox'>完成</label>");
					}else if(tabsize==0){
						ywc.splice(pos,0,"\u25cf "+document.getElementById("addwc").value+"<br>");
		
					}	
				//"<label><input type='checkbox'>搁置</label> <label><input type='checkbox'>完成</label>");
		}else if(n==2){
			ywc.push("&nbsp&nbsp&nbsp&nbsp");
				//"<label><input type='checkbox'>搁置</label> <label><input type='checkbox'>完成</label>");
		}
		
		document.getElementById("ywc01").innerHTML=print_array(ywc);
		document.getElementById("position").value++;
		document.getElementById("addwc").value="";
		
		sendJson();
	}
	
	document.getElementById("addwc").onkeydown=function(event){
		var keyCode= event.keyCode; 
		switch(keyCode){
			case 13:
				addwc(0);
				break;
			//case 17:
				delwc(0);
				break;
			//case 9:
				plus(1);
				break;
			//case 8:
				plus(0);
				break;
		}
	}
	
	function addlink(){
		 var pos=document.getElementById("position").value;
		 var tabsize= document.getElementById("tabsize").value;
		if((document.getElementById("linkInhalt").value == "")||(document.getElementById("weblink").value == "")){
			alert("Bitte Inhalt und URL eingeben!");
		}else{
			pos++;
			if(tabsize==0){
				ywc.splice(pos,0,"● <a target='_Blank' href="+document.getElementById("weblink").value+">"+document.getElementById("linkInhalt").value+"</a><br>");
			}else if(tabsize==1){
				ywc.splice(pos,0,">>>>● <a target='_Blank' href="+document.getElementById("weblink").value+">"+document.getElementById("linkInhalt").value+"</a><br>");
			}else if(tabsize==2){
				ywc.splice(pos,0,">>>>>>>>● <a target='_Blank' href="+document.getElementById("weblink").value+">"+document.getElementById("linkInhalt").value+"</a><br>");
			}
			document.getElementById("ywc01").innerHTML=print_array(ywc);
			document.getElementById("linkInhalt").value="";
			document.getElementById("position").value++;
			document.getElementById("weblink").value="";
		}
		
		sendJson();
	}
	function plus(n){
		if(n==0){
			document.getElementById("tabsize").value--;
		}else if(n== 1){
			document.getElementById("tabsize").value++;
		}else if(n==3){
			document.getElementById("position").value--;
		}else if (n==4){
			document.getElementById("position").value++;
		}
	}
	function delwc(n){
		if(n==0){
			ywc.splice(document.getElementById("position").value,1);
			document.getElementById("ywc01").innerHTML=print_array(ywc);
		}else if(n==1){
			ywc="";document.getElementById("ywc01").innerHTML=print_array(ywc);
		}
		document.getElementById("position").value--;
		
		sendJson();
	}
	
		mArray=new Array("richang","kaiyuan","yundong");
		cArray=new Array("日常","开源","运动");

		function ctable(){
			var mtable="<table border=1><tr>";


			for(var key in cArray){
					mtable+="<td>"+cArray[key]+"</td>";
			}
			mtable+="</tr><tr>";
			for(var key in mArray){
					mtable+="<td id="+mArray[key]+">tree</td>";
			}
			mtable+="</tr><tr>";
			for(var key in mArray){
					mtable+="<td><input id=add"+mArray[key]+"></input></td>";
			}
			mtable+="</tr><tr>";
			for(var key in mArray){
					mtable+="<td><button onclick=add"+mArray[key]+"(0)"+">Task+</button> \
								 <button onclick=del"+mArray[key]+"()"+">Task+</button> \
								 <button onclick=add"+mArray[key]+"(1)"+">Day+</button> </td>";
			}

			mtable+="</table>";
			document.getElementById("mtable").innerHTML=mtable;
		}


		function addrichang(num){

			alert("Click ！"+num);

		}
//定义函数：构建要显示的时间日期字符串
		function showTime()
		{
		 //创建Date对象
		 var today = new Date();
		 //分别取出年、月、日、时、分、秒
		 var year = today.getFullYear();
		 var month = today.getMonth()+1;
		 var day = today.getDate();
		 var hours = today.getHours();
		 var minutes = today.getMinutes();
		 var seconds = today.getSeconds();
		 //如果是单个数，则前面补0
		 month  = month<10  ? "0"+month : month;
		 day  = day <10  ? "0"+day : day;
		 //hours  = hours<10  ? "0"+hours : hours;
		 minutes = minutes<10 ? "0"+minutes : minutes;
		 seconds = seconds<10 ? "0"+seconds : seconds;
		 
		 var week;
		 //switch判断
		 switch (today.getDay()){
			case 1: week="Montag"; break;
			case 2: week="Dienstag"; break;
			case 3: week="Mittwoch"; break;
			case 4: week="Donnerstag"; break;
			case 5: week="Freitag"; break;
			case 6: week="Samstag"; break;
			default:week="Sonntag"; break;
		 }

		  var mk="Nachmittag";
			 if(hours<12)
			 	mk="Vormittag";
			 else if(hours>18)
			 	mk="Abend";


		var po = 1;
		 switch(hours){
		 	case 7:
		 	case 8:
		 	case 9:
		 	case 10:
		 	case 11:
		 		po=1;break;
		 	case 12:
		 	case 13:
		 	case 14:
		 	case 15:
		 	case 16:
		 		po=3;break;
		 	case 17:
		 	case 18:
		 	case 19:
		 	case 20:
		 	case 21:
		 		po=5;
		 }
		 //构建要输出的字符串
		 str = day+"/"+month+"/"+year+"/ "+"   "+hours+":"+minutes+":"+seconds;
		 var mytimestr = "";
		 if(23 - hours>0){
		 		mytimestr="剩余学习时间："+(22 - hours)+":"+(60-minutes);
		 }else{
		 		mytimestr="time to sleep";
		 }
		 
		 //获取id=result的对象
		 var obj = document.getElementById("result");
		 var timetogo =document.getElementById("resttime");
		  //var timePoint = document.getElementById("P0"+po);
		 //将str的内容写入到id=result的<div>中去
		 //timePoint.innerHTML="P";
		 obj.innerHTML = str;
		 //timetogo.innerHTML = mytimestr;
		 //延时器
		 window.setTimeout("showTime()",1000);
		}
	var key;	
	function addstate(){
		document.getElementById("tabsize").value=2;
		document.getElementById("addwc").value="ok";
		addwc(0);
		
		//alert(kk);
	}
	
	function pointto(kk){
		document.getElementById("position").value=kk;
		 window.location = "#mtable";
	}
		
	
	//打印数组  
	function print_array(arr){
		var arrstr="";  
	    for(key in arr){
			if(key!=0){
				//arrstr+='<button onclick="stateander('+key+')">OK</button>'+"   &nbsp"+'<button onclick="pointto('+key+')">'+key+'</button>'+":"+arr[key];
				arrstr+='<button onclick="pointto('+key+')" style="width:40px">'+key+'</button>'+":"+arr[key];
			
			}
		} 
	       
	   	return arrstr;
	     
	} 

	function printlast(arr){
		var arrstr=""; 
		var key = arr.length-1;
		while(arr[key]!="<br>↓================"){
			key--;
		}
		while(key<arr.length-1)
		{
			arrstr+=arr[key+1];
			key++;
		}
		return arrstr;
	       
	}


	var keyan = new Array();
	var chuangye = new Array();
	var tingdu = new Array();
	var kecheng = new Array();
	var yanjiu = new Array();
	var yuyan = new Array();
	

	// document.getElementById("tingdu").innerHTML=print_array(tingdu);
	// document.getElementById("kecheng").innerHTML=print_array(kecheng);
	// document.getElementById("keyan").innerHTML=print_array(keyan);
	// document.getElementById("chuangye").innerHTML=print_array(chuangye);
	// document.getElementById("yanjiu").innerHTML=print_array(yanjiu);
	// document.getElementById("yuyan").innerHTML=print_array(yuyan);



	function addky(n){
		if(n==1){keyan.push("<br>↓================");
		}else{keyan.push("<br>"+document.getElementById("addky").value);
		}document.getElementById("keyan").innerHTML=print_array(keyan);
		document.getElementById("addky").innerHTML="";
	}
	function delky(){
		keyan.pop();document.getElementById("keyan").innerHTML=print_array(keyan);
	}

	function addkc(n){
		if(n==1){kecheng.push("<br>↓================");
		}else{kecheng.push("<br>"+document.getElementById("addkc").value);
		}document.getElementById("kecheng").innerHTML=print_array(kecheng);
		document.getElementById("addkc").innerHTML="";
	}
	function delkc(){
		kecheng.pop();document.getElementById("kecheng").innerHTML=print_array(kecheng);
	}
///////////////////////////////////////
	function addcy(n){
		if(n==1){chuangye.push("<br>↓================");
		}else{chuangye.push("<br>"+document.getElementById("addcy").value);
		}document.getElementById("chuangye").innerHTML=print_array(chuangye);
		document.getElementById("addcy").innerHTML="";
	}
	function delcy(){
		chuangye.pop();document.getElementById("chuangye").innerHTML=print_array(chuangye);
	}

	function addyj(n){
		if(n==1){yanjiu.push("<br>↓================");
		}else{yanjiu.push("<br>"+document.getElementById("addyj").value);
		}document.getElementById("yanjiu").innerHTML=print_array(yanjiu);
		document.getElementById("addyj").innerHTML="";
	}
	function delyj(){
		yanjiu.pop();document.getElementById("yanjiu").innerHTML=print_array(yanjiu);
	}
///////////////////////////////////////
	function addtd(n){
		if(n==1){tingdu.push("<br>↓================");
		}else{tingdu.push("<br>"+document.getElementById("addtd").value);
		}document.getElementById("tingdu").innerHTML=print_array(tingdu);
		document.getElementById("addtd").innerHTML="";
	}
	function deltd(){
		tingdu.pop();document.getElementById("tingdu").innerHTML=print_array(tingdu);
	}

	function addyy(n){
		if(n==1){yuyan.push("<br>======day++======");
		}else{yuyan.push("<br>"+document.getElementById("addyy").value);
		}document.getElementById("yuyan").innerHTML=print_array(yuyan);
		document.getElementById("addyy").innerHTML="";
	}
	function delyy(){
		yuyan.pop();document.getElementById("yuyan").innerHTML=print_array(yuyan);
	}
    

	function excschi(){
		
	}
 /////////////////////////////////////////////========================================   
	function saveJson(){
		sendJson();
	}
    function sendJson() {
	
		if(ywc!=""){
		
			if(document.getElementById("fname").value!=""){
				filename.pop();
				filename.push(document.getElementById("fname").value);
			
				  $.ajax({
						type : "POST",  //提交方式
						url : "t.php",//路径,www根目录下
						data : {
							"ywc" : ywc,
							"filename": filename[0]
						},//数据，这里使用的是Json格式进行传输
						success : function(result) { 
							//document.getElementById("state").innerHTML = result;
							//alert(result);
						}
					});
			}else{
				alert("Bitte geben Sie den Name ein!");
			}
		
		}else{
			//alert("Inhalt ist leer!")
		}
	
      
    }

	function myreload(){
		sendJson()
		
		window.location.reload();
    }
	
	function refresh(){ 
	
   	   $.post("notiz/"+filename[0],function(data){
      		ywc.splice(0,ywc.length);//清空数组
      		$.each(data,function(infoIndex,info){
      		  ywc.push(info);
      		})
      		document.getElementById("ywc01").innerHTML=print_array(ywc);
   	  })
	
	}
	
	function loadfile(){
		if(document.getElementById("fname").value!=""){
			filename.pop();
			filename.push(document.getElementById("fname").value);
				$.post("notiz/"+filename[0],function(data){
						ywc.splice(0,ywc.length);//清空数组
						$.each(data,function(infoIndex,info){
						  ywc.push(info);
						})
						document.getElementById("ywc01").innerHTML=print_array(ywc);
				        document.getElementById("lange").innerHTML=ywc.length-1;
						
	                    document.getElementById("position").value=ywc.length-1;
				  })
			
		}else{
			alert("Bitte geben Sie den Name ein!");
		}
	}

	function genJob(){
			 document.getElementById("dwc").innerHTML=printlast(kecheng)+printlast(yuyan)+printlast(tingdu)+printlast(chuangye)+printlast(keyan)+printlast(yanjiu);
	}


	window.onload=function(){

		
		refresh();
		showTime();
	}	
</script>
</html>
<?php 
	//echo $_GET['fp'];
	echo "<script type='text/javascript'>document.getElementById('fname').value='".$_GET['fp']."';loadfile();</script>"; 
?>  
