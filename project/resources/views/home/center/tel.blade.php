@extends('layout.Center')
@section('title','电话号码')
@section('content')
	<div class="user-info">
		<!--标题 -->
		<div class="am-cf am-padding">
			<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">电话号码</strong></div>
		</div>
		<hr/>
		 @if(count($errors) > 0)
        <div class="mws-form-message error">
            <ul>
                @foreach($errors->all() as $error)
                    <li style="font-size: 17px; list-style:none">{{$error}}</li>
                @endforeach
            </ul>

        </div>
    	@endif 

		<!--个人信息 -->
		<div class="info-main">
			<form action="{{ url('/home/center/yzmUpdate')}}" method="post" class="am-form am-form-horizontal">

				<div class="am-form-group">
					<label for="user-phone" class="am-form-label">新手机号:</label>
					<div class="am-form-content" id="aa">
						<input id="user-phone" placeholder="请输入新手机号" type="text" value="" name="tel">
						<span> *请输入6~16位密码</span>
				
						<br>
						<input type="button" value="获取验证码" class="btn btn-danger" id="btn" onclick="sendCode(this)">
						<br>
						<script>

							//手机号
							//获取焦点
							$('#btn').attr("disabled",true);
							$('input[name=tel]').focus(function(){

								$(this).addClass('cur');
							})
							//失去焦点
							$('input[name=tel]').blur(function(){
								//获取手机号
								var tel = $(this).val();
								//正则
								var reg = /^1[34578]\d{9}$/;
								//检测
								if(!reg.test(tel)){
									$(this).css('border','solid 2px #db192a');
									$(this).next().text(' *手机号码不正确').css('color','#db192a');
									$('#btn').attr("disabled",true);
								} else {
									$(this).css('border','solid 2px green');
									$(this).next().text(' √').css('color','green');
									$('#btn').attr("disabled",false);
								}
							})

							var clock = '';
							 var nums = 60;
							 var btn;
							 function sendCode(thisBtn)
							 { 

								//获取手机号
								var tel = $('input[name=tel]').val();
								//发送ajax
								$.get("{{ url('/home/center/yzm')}}",{tel:tel},function(data){

									console.log(data);
								})

								 btn = thisBtn;
								 btn.disabled = true; //将按钮置为不可点击
								 btn.value = nums+'秒后可重新获取';
								 clock = setInterval(doLoop, 1000); //一秒执行一次
								 }
								 function doLoop()
								 {
								 nums--;
								 if(nums > 0){
								  btn.value = nums+'秒后可重新获取';
								 }else{
								  clearInterval(clock); //清除js定时器
								  btn.disabled = false;
								  btn.value = '点击发送验证码';
								  nums = 60; //重置时间
								 }
							 }
							 
						</script>
					</div>
					
				</div>
				<br><br>
				<label  class="am-form-label">手机验证码:</label>
					<div class="am-form-content">
						
						<input id="user-phone" placeholder="请输入手机验证码" type="text" name="yzm">
					</div>
				<br><br><br><br><br><br>
				<div class="info-btn">
    			{{ csrf_field()}}

					<input type="submit" value="保存修改" class="btn btn-danger">
				</div>

			</form>
		</div>

	</div>
@endsection

<!-- <script>
	
	$('.mws-form-message').delay(3000).slideUp(1000);

</script> -->