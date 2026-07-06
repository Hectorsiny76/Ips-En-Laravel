<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<div class="drop-shadow-mg  text-xs lg:text-lg flex items-center justify-between">

    <x-user-navbar-div-button dispatch="$dispatch('Cargar-componente', {componente:'user::livewire.aside.components.documentos'})" icon="📋" title="Archivos"/>

    <x-user-navbar-div-button dispatch="$dispatch('Cargar-componente', {componente:'user::livewire.aside.components.inc-generales'})" icon="❗" title="Generales"/>

    <x-user-navbar-div-button dispatch="$dispatch('Cargar-componente', {componente:'user::livewire.aside.components.problemas'})" icon="⚠️" title="Problemas"/>

    <x-user-navbar-div-button dispatch="$dispatch('Cargar-componente', {componente:'user::livewire.aside.components.requerimientos'})" icon="📑" title="RITM"/>

    <x-user-navbar-div-button
        href="https://7eleven.sharepoint.com/sites/Equipo6/SitePages/TrainingHome.aspx?csf=1&web=1&e=PiSIqx&CID=3e431f48-ea36-4501-84ff-b390f592db05"
        icon="👥"
        title="Sala de capacitacion"
        :link="true"
        />

</div>
