(function() {

  'use strict';

  //note de l'utilisateur
  var maNote = document.querySelector('#test');

  //Note actuelle de l'utilisateur
  var valNote = document.getElementById("valNow").getAttribute('value');

  // DUMMY DATA
  var data = [
    {
      rating: valNote/2
    }
  ];

  // INITIALIZE ajout de la note au widget
  (function init() {
    for (var i = 0; i < data.length; i++) {
      addRatingWidget(buildShopItem(data[i]), data[i]);
    }
  })();

  // BUILD SHOP ITEM Creation du code html
  function buildShopItem(data) {
    var noteItem = document.createElement('div');

    var html = '<div class="c-shop-item__img"></div>' +
      '<div class="c-shop-item__details">' +
        '<ul class="c-rating"></ul>' +
      '</div>';

    noteItem.classList.add('c-shop-item');
    noteItem.innerHTML = html;

    //Ajout du code a l'interieur de la div test
    maNote.appendChild(noteItem);

    return noteItem;
  }

  // ADD RATING WIDGET
  function addRatingWidget(shopItem, data) {
    var ratingElement = shopItem.querySelector('.c-rating');
    var currentRating = data.rating;
    var maxRating = 5;
    var ajoutNote = function(rating)
    {
        // Faire fonction pour ajouter l'avis dans la BD


    };

    var r = rating(ratingElement, currentRating, maxRating, ajoutNote);
  }

})();
