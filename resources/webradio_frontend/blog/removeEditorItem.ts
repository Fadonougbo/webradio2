//Supprime le element du localstorage dans le cas ou le contenu de l'editeur est valide
if(localStorage.getItem('editor_data')) {
    localStorage.removeItem('editor_data')
}
