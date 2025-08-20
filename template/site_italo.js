// Sample minimal data
const jogos = [
  {
    id: 1,
    titulo: 'Neon Runner',
    genero: 'corrida',
    desc: 'Corra entre os prédios sob chuva ácida.',
    cor: '#00F0FF',
    destaque: true,
    data: '2025-08-01',
  },
  {
    id: 2,
    titulo: 'Cyber Puzzle',
    genero: 'puzzle',
    desc: 'Conecte circuitos e acenda a grade.',
    cor: '#F8F000',
    destaque: true,
    data: '2025-08-05',
  },
  {
    id: 3,
    titulo: 'Blade Street',
    genero: 'ação',
    desc: 'Lute nas ruas de NightGrid.',
    cor: '#FF2A6D',
    destaque: true,
    data: '2025-07-20',
  },
  {
    id: 4,
    titulo: 'Ghost Protocol',
    genero: 'aventura',
    desc: 'Infiltração e furtividade neon.',
    cor: '#00FF87',
    destaque: false,
    data: '2025-06-11',
  },
  {
    id: 5,
    titulo: 'Pixel Drift',
    genero: 'corrida',
    desc: 'Derrapagens com luzes e vapor.',
    cor: '#00F0FF',
    destaque: false,
    data: '2025-08-10',
  },
  {
    id: 6,
    titulo: 'Quantum Blocks',
    genero: 'puzzle',
    desc: 'Quebre padrões quânticos.',
    cor: '#F8F000',
    destaque: false,
    data: '2025-07-28',
  },
]

const elCards = document.getElementById('cards')
const filters = document.querySelectorAll('[data-filter]')
const sortAlpha = document.getElementById('sortAlpha')
const sortRecent = document.getElementById('sortRecent')
const btnExplorar = document.getElementById('btnExplorar')
const btnAleatorio = document.getElementById('btnAleatorio')
const footerRandom = document.getElementById('footerRandom')

const searchModal = document.getElementById('searchModal')
const openSearch = document.getElementById('openSearch')
const closeSearch = document.getElementById('closeSearch')
const searchInput = document.getElementById('searchInput')
const searchResults = document.getElementById('searchResults')

let currentFilter = 'todos'
let currentSort = 'recent'

function renderCards() {
  const fragment = document.createDocumentFragment()
  elCards.innerHTML = ''
  let list = jogos.filter((j) =>
    currentFilter === 'todos' ? true : j.genero === currentFilter
  )
  // sorting
  if (currentSort === 'alpha') {
    list = list.slice().sort((a, b) => a.titulo.localeCompare(b.titulo))
  } else {
    list = list.slice().sort((a, b) => new Date(b.data) - new Date(a.data))
  }
  // show highlights first
  list = list
    .slice()
    .sort((a, b) => (b.destaque ? 1 : 0) - (a.destaque ? 1 : 0))

  list.forEach((j) => {
    const card = document.createElement('div')
    card.className =
      'card-outline neon-card bg-black/40 rounded-xl p-5 border border-white/10 flex flex-col gap-3'
    card.setAttribute('data-id', j.id)

    const top = document.createElement('div')
    top.className = 'flex items-start justify-between gap-3'
    const title = document.createElement('h3')
    title.className = 'font-[Outfit] text-lg font-semibold'
    title.style.color = j.cor
    title.textContent = j.titulo

    const tag = document.createElement('span')
    tag.className =
      'pill text-[10px] uppercase tracking-wider px-2 py-1 rounded-full text-white/80'
    tag.textContent = j.genero

    top.appendChild(title)
    top.appendChild(tag)

    const desc = document.createElement('p')
    desc.className = 'text-white/70 text-sm'
    desc.textContent = j.desc

    const bar = document.createElement('div')
    bar.className = 'mt-2 h-1.5 rounded-full'
    bar.style.background = `linear-gradient(90deg, ${j.cor}, rgba(255,255,255,.08))`
    bar.style.boxShadow = '0 0 14px rgba(255,255,255,.12)'

    const actions = document.createElement('div')
    actions.className = 'flex items-center gap-3 pt-2'
    const btnPlay = document.createElement('button')
    btnPlay.className =
      'btn-neon bg-[var(--cp-cyan)] hover:bg-[var(--cp-pink)] text-black hover:text-white transition px-4 py-2 rounded-md text-sm'
    btnPlay.textContent = 'Abrir página'
    btnPlay.addEventListener('click', () => openGame(j))

    const btnFav = document.createElement('button')
    btnFav.className =
      'neon-border bg-black/60 text-cyan-200 hover:text-pink-200 transition px-4 py-2 rounded-md text-sm'
    btnFav.textContent = isFav(j.id) ? 'Favorito ✓' : 'Favoritar'
    btnFav.addEventListener('click', () => {
      toggleFav(j.id)
      btnFav.textContent = isFav(j.id) ? 'Favorito ✓' : 'Favoritar'
    })

    actions.appendChild(btnPlay)
    actions.appendChild(btnFav)

    card.appendChild(top)
    card.appendChild(desc)
    card.appendChild(bar)
    card.appendChild(actions)
    fragment.appendChild(card)
  })
  elCards.appendChild(fragment)
}

// Simple "open page" demo: shows a modal card
function openGame(j) {
  const w = window.open('', '_blank')
  if (!w) {
    alert('Permit a abertura de pop-ups para ver a página do jogo.')
    return
  }
  const html = `
              <!DOCTYPE html>
              <html lang="pt-br">
              <head>
              <meta charset="utf-8">
              <meta name="viewport" content="width=device-width, initial-scale=1">
              <title>${j.titulo} — Friv Wiki Jogos</title>
              <link href="https://fonts.googleapis.com/css2?family=Michroma&family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
              <script src="https://cdn.tailwindcss.com"></script>
              </head>
              <body class="min-h-screen" style="background: radial-gradient(800px 500px at 60% -10%, rgba(0,240,255,.18), transparent 55%), linear-gradient(180deg,#0a0e13,#06080c); color:white;">
                <div class="max-w-3xl mx-auto p-6">
                  <a href="about:blank" onclick="window.close(); return false;" class="text-cyan-300">← Voltar</a>
                  <h1 class="mt-4" style="font-family:Michroma; color:${j.cor}; text-shadow:0 0 10px ${j.cor}; font-size:28px;">${j.titulo}</h1>
                  <p class="text-white/80 mt-2" style="font-family:Outfit;">${j.desc}</p>
                  <div class="mt-6 p-4 rounded-lg" style="background:rgba(0,0,0,.35); border:1px solid rgba(255,255,255,.12); box-shadow:0 0 0 2px rgba(0,240,255,.35), 0 0 18px rgba(0,240,255,.25); font-family:Outfit;">
                  Esta é uma página demo. Adicione aqui link oficial, instruções e capturas do jogo.
                  </div>
                </div>
                <script>
                  (function() {
                    function c() {
                      var b = a.contentDocument || a.contentWindow.document;
                      if (b) {
                        var d = b.createElement('script');
                        d.innerHTML = "window.__CF$cv$params={r:'9723db9512f71abe',t:'MTc1NTcxMzUzNC4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";
                        b.getElementsByTagName('head')[0].appendChild(d)
                      }
                    }
                    if (document.body) {
                      var a = document.createElement('iframe');
                      a.height = 1;
                      a.width = 1;
                      a.style.position = 'absolute';
                      a.style.top = 0;
                      a.style.left = 0;
                      a.style.border = 'none';
                      a.style.visibility = 'hidden';
                      document.body.appendChild(a);
                      if ('loading' !== document.readyState) c();
                      else if (window.addEventListener) document.addEventListener('DOMContentLoaded', c);
                      else {
                        var e = document.onreadystatechange || function() {};
                        document.onreadystatechange = function(b) {
                          e(b);
                          'loading' !== document.readyState && (document.onreadystatechange = e, c())
                        }
                      }
                    }
                  })();
                </script>
              </body>
              </html>`

  w.document.open()
  w.document.write(html)
  w.document.close()
}

// Favorites in localStorage
const FAV_KEY = 'frivwiki_favs'
function getFavs() {
  try {
    return JSON.parse(localStorage.getItem(FAV_KEY)) || []
  } catch (e) {
    return []
  }
}
function isFav(id) {
  return getFavs().includes(id)
}
function toggleFav(id) {
  const favs = getFavs()
  const idx = favs.indexOf(id)
  if (idx >= 0) favs.splice(idx, 1)
  else favs.push(id)
  localStorage.setItem(FAV_KEY, JSON.stringify(favs))
}

// Filters
filters.forEach((b) => {
  b.addEventListener('click', () => {
    currentFilter = b.getAttribute('data-filter')
    renderCards()
  })
})

// Sorting
sortAlpha.addEventListener('click', () => {
  currentSort = 'alpha'
  renderCards()
})
sortRecent.addEventListener('click', () => {
  currentSort = 'recent'
  renderCards()
})

// CTA buttons
btnExplorar.addEventListener('click', () => {
  window.scrollTo({ top: document.body.scrollHeight / 3, behavior: 'smooth' })
})
function randomGame() {
  const pick = jogos[Math.floor(Math.random() * jogos.length)]
  openGame(pick)
}
btnAleatorio.addEventListener('click', randomGame)
footerRandom.addEventListener('click', randomGame)

// Search modal
openSearch.addEventListener('click', () => {
  searchModal.classList.remove('hidden')
  setTimeout(() => searchInput.focus(), 50)
  renderSearch('')
})
closeSearch.addEventListener('click', () => searchModal.classList.add('hidden'))
searchModal.addEventListener('click', (e) => {
  if (e.target === searchModal) searchModal.classList.add('hidden')
})
searchInput.addEventListener('input', (e) => renderSearch(e.target.value))

function renderSearch(q) {
  const term = (q || '').toLowerCase().trim()
  const list = jogos.filter(
    (j) =>
      !term || j.titulo.toLowerCase().includes(term) || j.genero.includes(term)
  )
  searchResults.innerHTML = ''
  const frag = document.createDocumentFragment()
  list.forEach((j) => {
    const item = document.createElement('button')
    item.className =
      'neon-card bg-black/40 rounded-lg p-3 border border-white/10 text-left hover:bg-black/60 transition'
    item.innerHTML = `
  <div class="flex items-center justify-between gap-3">
    <div>
      <p class="font-semibold" style="color:${j.cor}">${j.titulo}</p>
      <p class="text-white/70 text-sm">${j.desc}</p>
    </div>
    <span class="pill text-[10px] px-2 py-1 rounded-full text-white/80">${j.genero}</span>
  </div>`
    item.addEventListener('click', () => openGame(j))
    frag.appendChild(item)
  })
  searchResults.appendChild(frag)
}

// Mode toggle (visual flavor)
const modeNeon = document.getElementById('modeNeon')
const modeClean = document.getElementById('modeClean')
modeNeon.addEventListener('click', () => {
  document.body.style.background =
    'radial-gradient(1200px 700px at 50% -20%, rgba(0,240,255,.18), transparent 60%), linear-gradient(180deg,#0a0e13,#06080c)'
})
modeClean.addEventListener('click', () => {
  document.body.style.background = 'linear-gradient(180deg,#0d1117,#0b0f14)'
})

// Initial render
renderCards()
