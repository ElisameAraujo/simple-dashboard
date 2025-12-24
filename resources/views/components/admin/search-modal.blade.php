<dialog id="spotlight" class="modal modal-search">
    <div class="modal-box modal__container">
        <!-- Input de busca -->
        <div class="modal__input">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input id="search-input" type="text" placeholder="Digite algo para pesquisar..." autocomplete="off" />
        </div>
        <!-- Filtros -->
        <div class="modal__filters">
            <span>Filtrar por:</span>
            <button class="filter-button active">Tudo (156)</button>
            <button class="filter-button">Posts (16)</button>
            <button class="filter-button">Artistas (75)</button>
            <button class="filter-button">Configurações (65)</button>
        </div>
        <!-- Resultados -->
        <ul id="search-results" class="modal-result__list">
            <li class="modal-result__item">
                <div class="thumbnail">
                    <i class="fa-solid fa-plus"></i>
                </div>
                <div class="result-text">
                    Novo Post
                    <span class="result-location">Página</span>
                </div>
            </li>
            <li class="modal-result__item">
                <div class="thumbnail">
                    <img src="{{ asset('img/temp/slider-1.jpg') }}" alt="">
                </div>
                <div class="result-text">
                    Do Hip-Hop ao Leste Vs. Oeste
                    <span class="result-location">Post</span>
                </div>
            </li>
            <li class="modal-result__item">
                <div class="thumbnail">
                    <i class="fa-solid fa-fingerprint"></i>
                </div>
                <div class="result-text">
                    Segurança
                    <span class="result-location">Configuração</span>
                </div>
            </li>

            <li class="modal-result__item">
                <div class="thumbnail">
                    <img src="{{ asset('img/temp/50-cent.jpg') }}" alt="">
                </div>
                <div class="result-text">
                    50 Cent
                    <span class="result-location">Artista</span>
                </div>
            </li>

            <li class="modal-result__item">
                <div class="thumbnail">
                    <i class="fa-regular fa-file-lines"></i>
                </div>
                <div class="result-text">
                    Páginas Estáticas
                    <span class="result-location">Configuração</span>
                </div>
            </li>

            <li class="modal-result__item">
                <div class="thumbnail">
                    <i class="fa-regular fa-file-lines"></i>
                </div>
                <div class="result-text">
                    Páginas Estáticas
                    <span class="result-location">Configuração</span>
                </div>
            </li>

            <li class="modal-result__item">
                <div class="thumbnail">
                    <i class="fa-regular fa-file-lines"></i>
                </div>
                <div class="result-text">
                    Páginas Estáticas
                    <span class="result-location">Configuração</span>
                </div>
            </li>

            <li class="modal-result__item">
                <div class="thumbnail">
                    <i class="fa-regular fa-file-lines"></i>
                </div>
                <div class="result-text">
                    Páginas Estáticas
                    <span class="result-location">Configuração</span>
                </div>
            </li>
        </ul>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>
