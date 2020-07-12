<section id="section1">
    <h2 class="accountTextHeader">Hi,<span class="accountSpanHeader"><?= $user->Prenom ?></span></h2>
    <article class="articleP1">
        <a href="index/client/command/" class="articleP1__link ">My Commands</a>
        <a href="?index.php&controller=client&action=edit" class="articleP1__link ">Edit my profile</a>
        <!-- index/client/edit/1/ -->
        <a href="?index.php&controller=client&action=logout" class="articleP1__link ">log out</a>
    </article>
    <article class="articleP2">
        <h4 class="accountInfotitle">Name: <span class="accountInfoData"><?= $user->Prenom . " " . $user->Nom ?></span></h4>
        <h4 class="accountInfotitle">Email: <span class="accountInfoData"><?= $user->Email ?></span></h4>
        <h4 class="accountInfotitle">Phone: <span class="accountInfoData"><?= $user->Phone ?></span></h4>
        <h4 class="accountInfotitle">Birth Date: <span class="accountInfoData"><?= $user->BirthDate ?></span></h4>
        <h4 class="accountInfotitle">Gender: <span class="accountInfoData"><?= $user->Gender ?></span></h4>
        <h4 class="accountInfotitle">Full Address: <span class="accountInfoData"><?= $user->Adresse ?></span></h4>
    </article>

</section>