<html>
<head>
<script type="text/javascript">
function a(){
	<?php 
	print "var num=".$this->data->getNum().";";
	?>
	location.href="/article/index.php?action=del&num="+num;
}
</script>
</head>
<body>
	<a href='/article/index.php?action=list'>글 목록으로 돌아가기</a>
	<form name="f" action="/article/index.php?action=edit" method="POST">
		<table border="2">
			<tr>
				<td>글 번호</td>
				<td><input type="text" name="num" value="<?php print $this->data->getNum(); ?>" readonly></td>
			</tr>
			<tr>
				<td>제목</td>
				<td><input type="text" name="title" value="<?php print $this->data->getTitle(); ?>" ></td>
			</tr>
			<tr>
				<td>작성자</td>
				<td><input type="text" name="writer" value="<?php print $this->data->getWriter();?>" ></td>
			</tr>
			<tr>
				<td>작성 날짜</td>
				<td><input type="text" name="wdate" value="<?php print $this->data->getWdate();?>" readonly></td>
			</tr>
			<tr>
				<td>카테고리</td>
				<td><select name="category">
				<?php
				foreach ( $this->category as $c ) {
					if($this->data->getCategory() == $c){
						$opt="selected='selected'";
					}
					print "<option value='" . $c->getId () ."' ".$opt.">" . $c->getName () . "</option>";
					if($this->data->getCategory() == $c){
						$opt="";
					}
				}
				?>
</select></td>
			</tr>
			<tr>
				<td colspan=2>글 내용</td>
			</tr>
			<tr>
				<td colspan=2><textarea rows="30" cols="40" name="content" ><?php print $this->data->getContent(); ?></textarea></td>
			</tr>
			<tr>
				<td colspan=2>
				<input type="submit" value="편집"> 
				<input type="button" value="삭제" onclick="a()">
				</td>
			</tr>
		</table>
	</form>
	
</body>
</html>