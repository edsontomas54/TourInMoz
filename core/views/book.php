
    <!-----header-Section ends------>

    <div class="heading" style="background:url(assets/images/mocambique.png) no-repeat;">
    <h1>Book now</h1>
</div>


<!-- section booking starts -->
<section class="booking-container">

    <h1 class="head-title">Garanta a sua Viajem!</h1>

    <form action="?a=book" method="post" class="book-form">

        <div class="flex-inputs">

            <div class="inputBox">
                <span>nome :</span>
                <input type="text" name="nome" placeholder="Digite o seu nome">
            </div>

            <div class="inputBox">
                <span>email :</span>
                <input type="email" name="email" placeholder="Digite o seu email">
            </div>

            <div class="inputBox">
                <span>Telefone :</span>
                <input type="number" name="telefone" placeholder="Digite o seu numero de Telefone">
            </div>

            <div class="inputBox">
                <span>indereço :</span>
                <input type="text" name="indereco" placeholder="Digite o seu indereco" value="">
            </div>

            <div class="inputBox">
                <span>Onde vai :</span>
                <input type="text" name="locali" placeholder="Digite o sitio que quer visitar">
            </div>

            <div class="inputBox">
                <span>quatos visitantes :</span>
                <input type="number" name="visitante" placeholder="Digite o numero de visitantes">
            </div>

            <div class="inputBox">
                <span>Saida :</span>
                <input type="date" name="saida">
            </div>

            <div class="inputBox">
                <span>chegada :</span>
                <input type="date" name="chegada">
            </div>
        </div>
        <input type="submit" name="enviar" value="Submit" class="btn">
    </form>

</section>

<!-- section booking fim -->
