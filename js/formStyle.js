/**
 * ?Put a class into the input selected to aplicate the css effect form
 */

$(".txtb input").on("focus", function() {
  $(this).addClass("focus");
});
/**
 * ?Remove the class in the moment that you jump into the other input and you don't put information
 */
$(".txtb input").on("blur", function() {
  if ($(this).val() == "") $(this).removeClass("focus");
});
