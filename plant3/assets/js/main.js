function sOpenNav() {
  document.querySelectorAll('.nav-toggle').forEach((e) => {
    e.classList.add('active')
  })
  document.querySelectorAll('.nav-panel').forEach((e) => {
    e.classList.add('active')
  })
  document.body.classList.add('modal-active')
  // Close Search
  document.querySelector('.search-panel').classList.remove('active')
  document.querySelectorAll('.search-toggle').forEach((e) => {
    e.classList.remove('close')
  })
  document.body.classList.remove('-search')
}
function sCloseNav() {
  document.querySelectorAll('.nav-toggle').forEach((e) => {
    e.classList.remove('active')
  })
  document.querySelectorAll('.nav-panel').forEach((e) => {
    e.classList.remove('active')
  })
  document.body.classList.remove('modal-active')
  sCloseBanner()
}
function sCloseBanner(blockID) {
  const banner = document.querySelector('.p-banner-modal')
  if (banner) {
    banner.style.display = 'none'
    document.body.classList.remove('modal-active')
    // blockID = blockID || banner.id;
    if (blockID) {
      const modalEvent = localStorage.getItem(blockID)
      if (modalEvent == null) {
        localStorage.setItem(blockID, 'closed')
      }
    }
  }
}

document.addEventListener(
  'click',
  function (e) {
    // NAV
    if (e.target.closest('.nav-toggle')) {
      if (e.target.closest('.nav-toggle').classList.contains('active')) {
        sCloseNav()
      } else {
        sOpenNav()
      }
    }
    if (e.target.matches('.menu-item-has-children > .i-down')) {
      e.target.parentNode.classList.toggle('active')
    }
    if (e.target.closest('.menu-item:not(.search-toggle) a')) {
      if (e.target.getAttribute('href') == '#' && screen.width < 1024) {
        e.target.parentNode.classList.toggle('active')
      } else {
        sCloseNav()
      }
    }
    // SEARCH
    if (e.target.closest('.search-toggle')) {
      const searchToggle = e.target.closest('.search-toggle')
      const isClosing = searchToggle.classList.contains('close')
      const searchInput = document.getElementById('s')

      searchToggle.classList.toggle('close')
      document.body.classList.toggle('modal-active')
      document.body.classList.toggle('-search')
      document.querySelector('.search-panel').classList.toggle('active')

      if (isClosing) {
        searchInput.blur()
        // Force keyboard to hide on mobile
        searchInput.setAttribute('readonly', 'readonly')
        setTimeout(() => {
          searchInput.removeAttribute('readonly')
        }, 100)
      } else {
        searchInput.focus()
      }
    }
    // MODAL BG
    if (e.target.closest('.site-modal-bg')) {
      sCloseNav()
      const st = document.querySelector('.search-toggle')
      const sp = document.querySelector('.search-panel')
      if (st) st.classList.remove('close')
      if (sp) sp.classList.remove('active')
      document.body.classList.remove('-search')
    }
    // FOOT NAV
    if (e.target.closest('.s-menu h2, .s-menu h3, .s-menu-title')) {
      e.target.closest('.s-menu').classList.toggle('active')
    }
    // CHAT BUTTON
    if (e.target.closest('#s-chat')) {
      e.target.classList.remove('-desc')
      e.target.classList.add('closed')
      e.target.classList.add('active')
      var s_chat_panel = document.getElementById('s-chat-panel')
      if (s_chat_panel.classList.contains('active')) {
        s_chat_panel.classList.remove('active')
        e.target.classList.remove('active')
      } else {
        s_chat_panel.classList.add('active')
      }
    }
  },
  false
)

// Add Dropdown Toggle
document.querySelectorAll('.nav-panel .menu-item-has-children').forEach((e) => {
  e.insertAdjacentHTML(
    'beforeend',
    '<svg xmlns="http://www.w3.org/2000/svg" class="i-down" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>'
  )
})

// INI FUNCTION
function ini() {
  // SCROLL https://developer.mozilla.org/en-US/docs/Web/API/Document/scroll_event
  const data = document.getElementById('data')
  if (data) {
    if (data.dataset.hfx) {
      const hfx = data.dataset.hfx
      const s_chat = document.getElementById('s-chat')
      let pos = 0
      let addfixed = false
      function header_active(scrollPos) {
        if (hfx < scrollPos) {
          document.getElementById('masthead').classList.add('active')
          if (s_chat) {
            if (!s_chat.classList.contains('closed')) {
              s_chat.classList.add('-desc')
            }
          }
        } else {
          document.getElementById('masthead').classList.remove('active')
        }
      }
      document.addEventListener('scroll', (e) => {
        pos = window.scrollY
        if (!addfixed) {
          window.requestAnimationFrame(() => {
            header_active(pos)
            addfixed = false
          })
          addfixed = true
        }
      })
    }
  }
  // EXTENSION: RELLAX
  if (typeof Rellax === 'function') {
    if (document.querySelector('.s-lax')) {
      var rellax = new Rellax('.s-lax')
    }
  }
  // EXTENSION: LIGHTGALLERY
  if (typeof lightGallery === 'function') {
    const lgs = document.querySelectorAll('.s-lg')
    if (lgs) {
      lgs.forEach((e) => {
        lightGallery(e, {
          download: false,
          selector: 'a',
          licenseKey: '99753FAA-B8D34C7A-AAD84FAA-071A8236',
          plugins: [lgVideo],
        })
      })
    }
    const wpg = document.querySelectorAll('.wp-block-gallery')
    if (wpg) {
      wpg.forEach((e) => {
        lightGallery(e, {
          selector: 'a',
          licenseKey: '99753FAA-B8D34C7A-AAD84FAA-071A8236',
        })
      })
    }
  }
}
document.addEventListener('DOMContentLoaded', ini(), false)
