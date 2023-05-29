import axios from 'axios'

class Search {
  // 1. describe and create/initiate our object
  constructor() {
    this.addSearchHTML()
    this.resultsDiv = document.querySelector('#search-results')
    this.openButton = document.querySelector('.js-search-trigger')
    this.closeButton = document.querySelector('.search-overlay_close')
    this.searchOverlay = document.querySelector('.search-overlay')
    this.searchField = document.querySelector('#search-term')
    this.events()
    this.isOverlayOpen = false
    this.isSpinnerVisible = false
    this.previousValue
    this.typingTimer
  }

  // 2. events
  events() {
    this.openButton.addEventListener('click', () => this.openOverlay())
    this.closeButton.addEventListener('click', () => this.closeOverlay())
    document.addEventListener('keydown', e => this.keyPressDispatcher(e))
    this.searchField.addEventListener('keyup', () => this.typingLogic())
  }

  // 3. methods (function, action...)
  typingLogic() {
    if (this.searchField.value != this.previousValue) {
      clearTimeout(this.typingTimer)
      if (this.searchField.value) {
        if (!this.isSpinnerVisible) {
          this.resultsDiv.innerHTML = `
            <div class="d-flex justify-content-center">
              <div class="spinner-border" role="status">
                <span class="visually-hidden">Carregando...</span>
              </div>
            </div>
            `
          this.isSpinnerVisible = true
        }
        this.typingTimer = setTimeout(this.getResults.bind(this), 750)
      } else {
        this.resultsDiv.innerHTML = `
        <h2></h2>
        `
        this.isSpinnerVisible = false
      }
    }
    this.previousValue = this.searchField.value // get the value of the search field
  }

  async getResults() {
    try {
      const response = await axios.get(
        data.root_url +
          '/wp-json/caixola/v1/search?term=' +
          this.searchField.value
      )
      const results = response.data

      this.resultsDiv.innerHTML = `
        <div class="row">
          <div class="col-12">
            <h2>Informações Gerais</h2>
            ${
              results.generalInfo.length
                ? '<ul class="results-list">'
                : '<p>Não há resultados</p>'
            }
              ${results.generalInfo
                .map(
                  item =>
                    `<li>
                      <a href="${item.permalink}">
                        ${item.title}
                      </a>  
                      ${
                        item.postType == 'criado'
                          ? `por ${item.authorName}`
                          : ''
                      }
                    </li>`
                )
                .join('')}
            ${results.generalInfo.length ? '</ul>' : ''}
          </div>
        </div>
      `
      this.isSpinnerVisible = false
    } catch (e) {
      console.log(e)
    }
  }

  keyPressDispatcher(e) {
    if (
      e.keyCode == 83 &&
      !this.isOverlayOpen &&
      document.activeElement.tagName != 'INPUT' &&
      document.activeElement.tagName != 'TEXTAREA'
    ) {
      this.openOverlay()
    }

    if (e.keyCode == 27 && this.isOverlayOpen) {
      this.closeOverlay()
    }
  }

  openOverlay() {
    setTimeout(() => this.searchField.focus(), 300)
    this.searchOverlay.classList.remove('d-none')
    document.body.classList.add('body-no-scroll')
    this.searchField.value = ''
    //console.log('our open method just ran!')
    this.isOverlayOpen = true
    return false
  }

  closeOverlay() {
    this.searchOverlay.classList.add('d-none')
    document.body.classList.remove('body-no-scroll')
    //console.log('our close method just ran!')
    this.isOverlayOpen = false
  }

  addSearchHTML() {
    document.body.insertAdjacentHTML(
      'beforeend',
      `
      <div class="container-fluid search-overlay d-none">
        <div class="row mt-5">
          <div class="col-12 d-flex flex-row">
            <input class="form-control me-2 search-term"
              type="search"
              placeholder="O que você está procurando?"
              aria-label="Pesquisar" id="search-term"
              autocomplete="off"
            />
            <span class="btn btn-outline-success search-overlay_close" type="submit">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16" search-overlay_icon>
                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
              </svg>
            </span>
          </div>
        </div>
        <div class="row mt-5 text-white">
          <div id="search-results" class="col-12">
            
          </div>
        </div>
      </div>
    `
    )
  }
}

export default Search
