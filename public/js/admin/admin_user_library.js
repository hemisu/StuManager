/**
 * Created by hekunyu on 16/2/17.
 */
function detailFormatter(index, row) {
//		console.log(row);
	var html = [];
	html.push('<table style="background-color: #f4f4f4;">');
	$.each(row, function (key, value) {
	if(key == 'long_phone'){
	html.push('<tr style="border-top: 1px solid #dddddd;"><td width="80">' + key + '</td><td> <a href="tel:'+value+'">' + value + '</a></td></tr>');

	}else if(key == 'short_phone'){
	html.push('<tr style="border-top: 1px solid #dddddd;"><td width="80">' + key + '</td><td> <a href="tel:'+value+'">' + value + '</a></td></tr>');
	}else{
	html.push('<tr style="border-top: 1px solid #dddddd;"><td width="80">' + key + '</td><td> ' + value + '</td></tr>');
	}

	});
	html.push('</table>');
	return html.join('');
	}
function operateFormatter(value, row, index) {
	return [
	'<a class="like" href="'+SITE_URL+'admin/user_edit/'+row.student_id+'" title="Like">',
	'<i class="glyphicon glyphicon-edit"></i>',
	'</a>  ',
	'<a class="remove" href="javascript:void(0)" onclick="if(confirm(\'确定删除?\')==false)return false;" title="Remove">',
	'<i class="glyphicon glyphicon-remove"></i>',
	'</a>'
	].join('');
	}
window.operateEvents = {
	'click .remove': function (e, value, row, index) {
	$.ajax({
	type: 'get',
	url: SITE_URL+'admin/user_delete'+'/'+row.student_id,
	data: {student_id : row.student_id} ,
	dataType:'json',
	success:function(result) {
	if (result.response == false ) {
	$.scojs_message('删除失败', $.scojs_message.TYPE_ERROR);
	} else {
	console.log(result);
	$.scojs_message('删除成功', $.scojs_message.TYPE_OK);
	}
	}
	});
	$('#user_library').bootstrapTable('remove', {
	field: 'student_id',
	values: [row.student_id]
	});

	}
	};
