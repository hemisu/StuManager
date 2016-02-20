/**
 * Created by hekunyu on 16/2/17.
 */
$(function () {
	$(".announcecontent").each(function () {
		var maxwidth = 100;
		if ($(this).text().length > maxwidth) {
			var myid= $(this).data('announceid');
			$(this).html($(this).html().substring(0, maxwidth));
			$(this).html($(this).html() + '<a href="'+SITE_URL+'dashboard/announce/announce_id/'+myid+'">查看更多</a>');
		}
	});
});