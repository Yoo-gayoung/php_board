<html>
<head>
</head>
<body>
	<h3>글쓰기</h3>
	<a href='/article/index.php?action=list'>글 목록으로 돌아가기</a>
	<form name="f" action="/article/index.php?action=write" method="POST">
		<table border="2">
			<tr>
				<td>제목</td>
				<td><input type="text" name="title"></td>
			</tr>
			<tr>
				<td>작성자</td>
				<td><input type="text" name="writer"></td>
			</tr>
			<tr>
				<td>카테고리</td>
				<td><select name="category">
				<?php
				foreach ( $this->category as $c ) {
				print "<option value=" . $c->getId () . ">" . $c->getName () . "</option>";
				}
				?>
</select></td>
			</tr>
			<tr>
				<td colspan=2>글 쓰기</td>
			</tr>
			<tr>
				<td colspan=2><textarea rows="30" cols="40" name="content"></textarea></td>
			</tr>
			<tr>
				<td colspan=2><input type="submit" value="완료"> 
				<input type="reset" value="다시 쓰기"></td>
			</tr>
		</table>
	</form>
</body>
</html>