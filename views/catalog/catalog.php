<br/>
<h2>Каталог</h2>
<br/>
<div class="row">
    <? foreach ($catalog as $item): ?>
        <div class="col-3">
            <div class="card">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="/product/card/?id=<?= $item['id'] ?>">
                            <?= $item['name'] ?>
                        </a>
                    </h5>
                    <p class="card-text">
                        Цена: <?= $item['price'] ?>
                    </p>
                    <button data-id="<?= $item['id'] ?>" class="btn col-12 btn-primary stretched-link buy">Купить</button>
                </div>
            </div>
            <br/>
        </div>
    <? endforeach; ?>
</div>


<script>
    let buttons = document.querySelectorAll('.buy');

    buttons.forEach((elem) => {
        elem.addEventListener('click', () => {
            let id = elem.getAttribute('data-id');
            (async () => {
                const response = await fetch('/Api/AddBasket/', {
                    method: 'POST',
                    headers: new Headers({
                        'Content-Type': 'application/json'
                    }),
                    body: JSON.stringify({
                        id: id
                    }),
                });
                const answer = await response.json();
                document.getElementById('count').innerText = answer.count;

            })();
        })
    })
</script>