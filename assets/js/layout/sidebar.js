const sideBar = $('.sidebar')
const collapsibleSideItems = $('.collapsible')
const hamburgerMenu = $('.hamburger-menu')
const sideBarClose = $('.sidebar-close')

function setCollapsedState($el, $subItemWrapper, $closestListItem) {
    $closestListItem.hasClass('active') ? $el.removeClass('collapsed') : $el.addClass('collapsed')

    const isCollapsed = $el.hasClass('collapsed')
    const iconClass = isCollapsed ? 'ph-caret-right' : 'ph-caret-down'
    const icon = `<i class="sidebar-icons collapsible-icon p-0 ph ${iconClass}"></i>`

    $el.find('.collapsible-icon').remove()
    $el.append(icon)

    let isAnimated = true

    $('.second-side-item, .third-side-item').each((i, element) => {
        if ($(element).hasClass('no-transition')) {
            isAnimated = false 
        }
    })

    isAnimated ? $subItemWrapper[0].style.transition = 0.3 + 's' : $subItemWrapper[0].style.transition = 'none'

    if (!isCollapsed) {
        let height = $subItemWrapper[0].scrollHeight

        if ($subItemWrapper.hasClass('second-side-item-wrapper')) {
            $subItemWrapper.find('.third-side-item-wrapper').each((i, element) => {
                height += element.scrollHeight
            })
        }

        $subItemWrapper[0].style.maxHeight = height + "px"
    } else {
        $subItemWrapper[0].style.maxHeight = null
    }
}

function updateCollapsedItem($el) {
    const $subItemWrapper = $el.next('.second-side-item-wrapper, .third-side-item-wrapper')
    const $closestListItem = $el.closest('li')

    $closestListItem.toggleClass('active')

    $('.second-side-item, .third-side-item').each((i, element) => {
        if ($(element).hasClass('no-transition')) {
            $(element).removeClass('no-transition')
        }
    })

    setCollapsedState($el, $subItemWrapper, $closestListItem)
}

collapsibleSideItems.each((i, element) => {
    const el = $(element)
    const closestListItem = el.closest('li')
    const subItemWrapper = el.next('.second-side-item-wrapper, .third-side-item-wrapper')

    setCollapsedState(el, subItemWrapper, closestListItem)

    el.on('click', function (e) {
        e.preventDefault()

        $(this).toggleClass('collapsed')
        updateCollapsedItem($(this))
    })
})

hamburgerMenu.on('click', () => {
    sideBar.addClass('show')
})

sideBarClose.on('click', () => {
    sideBar.removeClass('show')
})

$(document).on('click', e => {
    !sideBar[0].contains(e.target) && !hamburgerMenu[0].contains(e.target) && !$(e.target).hasClass('sidebar-icons') ? sideBar.removeClass('show') : ''
})
