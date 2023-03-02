<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Other/html.html to edit this template
-->

<html>
    <?php 
    include "head.inc.php";
    ?>
    <body>
        <?php
        include "nav.inc.php";
        ?>

        <header class="jumbotron text-center"> 
            <h1>Welcome to World of Pets!</h1>
            <h3> Home of Singapore's Pet Lovers </h3> 
        </header>    

        <main class="container">
            <section id="dogs">
                <h2>All About Dogs!</h2>
                <div class="row">
                    <article class="col-sm">
                        <h3>Poodles</h3>
                        <figure>
                            <img id="Poodle" src="images/poodle_small.jpg" alt="Poodle" 
                                 title="View larger image..." class="img-thumbnail"/>
                            <figcaption>Standard Poodle</figcaption>
                        </figure>
                        <p>
                            Poodles are a group of formal dog breeds, the Standard
                            Poodle, Miniature Poodle and Toy Poodle...
                        </p>

                    </article>
                    <article class="col-sm">
                        <h3>Chihuahua</h3>
                        <figure>

                            <img src="images/chihuahua_small.jpg" alt="Chihuahua"
                                 title="View larger image..." class="img-thumbnail"/>

                            <figcaption>Standard Chihuahua</figcaption>
                        </figure>
                        <p>
                            The Chihuahua is the smallest breed of dog, and is named
                            after the Mexican state of Chihuahua...
                        </p>
                    </article>
                </div>
            </section>
            <section id="cats">
                <h2> All About Cats!  </h2>
                <div class="row">
                    <article class="col-sm">
                        <h3> Tabby  </h3>
                        <figure>

                            <img src="images/tabby_small.jpg" alt="Tabby"
                                 title="View larger image..." class="img-thumbnail"/>

                            <figcaption>Standard Tabby</figcaption>
                        </figure>
                        <p> 
                            A tabby is any domestic cat with an 'M' forehead, stripes by 
                            its eyes and across its cheeks.
                        </p>
                    </article>
                    <article class="col-sm">
                        <h3> Calico  </h3>
                        <figure>

                            <img src="images/calico_small.jpg" alt="Calico"
                                 title="View larger image..." class="img-thumbnail"/>

                            <figcaption>Standard Calico</figcaption>
                        </figure>
                        <p> 
                            A calico cat is a domestic cat with a coat that is typically
                            25% to 75% white and has large orange and black patches.
                        </p>
                    </article>
                </div>
            </section>
        </main>
        <?php
        include "footer.inc.php";
        ?>
    </body>
</html>
