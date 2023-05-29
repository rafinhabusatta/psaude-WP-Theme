import axios from 'axios'

class Search {
  // 1. describe and create/initiate our object
  constructor() {
    this.resultsDiv = document.querySelector('#portfolio-search')
    this.searchButton = document.querySelector('#portfolio-search-trigger')
    this.searchData = document.querySelector('#data')
    this.searchEquipe = document.querySelector('#equipe')
    this.searchProjeto = document.querySelector('#projeto')
    this.searchField = {
      projeto: this.searchProjeto.value,
      equipe: this.searchEquipe.value,
      data: this.searchData.value
    }
    this.events()
    this.isSpinnerVisible = false
    this.previousValue
    this.typingTimer
  }

  // 2. events
  events() {
    //this.searchField.addEventListener('keyup', () => this.typingLogic())
    this.searchButton.addEventListener('click', () => this.getResults())
  }

  // 3. methods (function, action...)
  typingLogic() {
    if (this.searchField.projeto.value != this.previousValue) {
      clearTimeout(this.typingTimer)
      if (this.searchField.projeto.value) {
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
    this.previousValue = this.searchField.projeto.value // get the value of the search field
  }

  async getResults() {
    document.querySelector('.portfolio-all').classList.add('d-none')
    try {
      const response = await axios.get(
        data.root_url +
          '/wp-json/psaude/v1/search?term=' +
          this.searchProjeto.value +
          '&authorName=' +
          this.searchEquipe.value +
          '&projectDate=' +
          this.searchData.value
      )
      const results = response.data

      this.resultsDiv.innerHTML = `
        <div class="row row-cols-1 row-cols-md-3 g-4 align-items-center">
          ${
            results.portfolio.length
              ? ''
              : '<div class="col">Nenhum resultado encontrado.</div>'
          }
            ${results.portfolio
              .map(
                item =>
                  `<div class="col">
                    <a href="${item.permalink}">
                      <div class="card portfolio-card">
                        <div class="card-body bg-portfolio-card" style="background-image: url(<?php echo $cardImage; ?>);">
                          <img src="<?php ?>" alt="">
                          <h5 class="card-title">${item.title}</h5>
                        </div>
                        <div class="card-footer">
                          ${item.projectType}
                        </div>
                      </div>
                    </a>
                  </div>`
              )
              .join('')}
        </div>
      `
      this.isSpinnerVisible = false
    } catch (e) {
      console.log(e)
    }
  }
}

export default Search
