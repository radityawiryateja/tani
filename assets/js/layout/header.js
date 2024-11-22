const profileWrapper = $('.profile-wrapper')
const profileBtn = $('#profile-btn')
const profileIcon = $('.profile-icon')

$(document).on('click', function (e) {
    if (profileBtn[0].contains(e.target) || profileIcon[0].contains(e.target)) {
        profileWrapper.toggleClass('active')
    } else {
        profileWrapper.hasClass('active') ? profileWrapper.removeClass('active') : ''
    }
})
