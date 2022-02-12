let comments = $('.comments .page-card-content');
let replyComment = document.querySelector('.replying-comment');

// Get current date
const namaBulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
const ambilDate = new Date();
const tahun = ambilDate.getFullYear();
const bulan = namaBulan[ambilDate.getMonth()];
const tanggal = String(ambilDate.getDate()).padStart(2, '0');
let tglComment = tanggal + ' ' + bulan + ' ' + tahun;
let commentWrapper = 'comment';
let commentReplyWrapper = 'comment-1'
let commentId;
let commentAttr;

// Get selected comment to reply on click
$('.user-comment').on('click', '.btn-reply-comment', function(ev) {
    let userComment = $(this).parent();
    commentAttr = userComment.parent().attr('id');
    commentId = commentAttr.slice(-1)
    let replyCommentWrapper = $(this).parent().clone(true);
    let commentContent = replyCommentWrapper.children().last().remove();

    // show selected comment to reply
    let replyWrapper = document.querySelector('.replying-comment');
    let replyTag = document.createElement('span');
    replyTag.classList.add('reply-sub')
    replyTag.innerHTML = 'Reply <i class="bi bi-reply-fill flipped"></i>'
    replyWrapper.append(replyTag);
    replyCommentWrapper.appendTo(replyWrapper);
    $('.replying-comment').css('display', 'block');
	$('#comment-form #parent').val(commentId);
    $('html, body').animate({
        scrollTop: $("#comment-form").offset().top
    }, 1000);
})
