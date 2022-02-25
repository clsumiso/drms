<?php

    session_start();
    if(isset($_SESSION['upload']) && isset($_SESSION['user'])) {

        echo '<div class="modal-feedback">'.
                '<div class="modal-feedback-wrapper">'.
                    '<form id="submitReviewForm" action="insert_ratings_db.php" method="POST">'.
        
                        '<h4 class="poppins mt-3 mb-3 text-center">Please answer our quick survey to improve our services</h4>'.
                        '<hr>'.
                        '<div class="row mt-4 mb-3">'.
                            '<div class="ratings-star-wrapper form-group col-lg col-md">'.
                                '<label class="form-label">User Friendly</label>'.
                                '<div class="star-wrapper">'.
                                    '<div class="rating">'.
                                        '<input type="radio" name="star" id="star1" value="5" ><label for="star1"></label>'.
                                        '<input type="radio" name="star" id="star2" value="4"><label for="star2"></label>'.
                                        '<input type="radio" name="star" id="star3" value="3"><label for="star3"></label>'.
                                        '<input type="radio" name="star" id="star4" value="2"><label for="star4"></label>'.
                                        '<input type="radio" name="star" id="star5" value="1" checked><label for="star5"></label>'.
                                    '</div>'.
                                '</div>'.
                            '</div>'.
        
                            '<div class="ratings-star-wrapper form-group col-lg col-md">'.
                                '<label class="form-label">Informative</label>'.
                                '<div class="star-wrapper">'.
                                    '<div class="rating">'.
                                        '<input type="radio" name="star2" id="star21" value="5" ><label for="star21"></label>'.
                                        '<input type="radio" name="star2" id="star22" value="4"><label for="star22"></label>'.
                                        '<input type="radio" name="star2" id="star23" value="3"><label for="star23"></label>'.
                                        '<input type="radio" name="star2" id="star24" value="2"><label for="star24"></label>'.
                                        '<input type="radio" name="star2" id="star25" value="1" checked><label for="star25"></label>'.
                                    '</div>'.
                                '</div>'.
                            '</div>'.
                        '</div>'.
        
                        '<div class="form-group mb-3">'.
                            '<textarea name="getSuggestion" id="getSuggestion" cols="30" rows="7" maxlength="1000" class="form-control" placeholder="Comment your suggestion here ..."></textarea>'.
                        '</div>'.
        
                        '<hr>'.
        
                        '<div class="form-group float-end mb-3">'.
                            '<button class="btn btn-secondary poppins me-2" id="btnCloseFeedback" type="button">Back</button>'.
                            '<button class="btn btn-success poppins" type="submit">Submit</button>'.
                        '</div>'.
        
                    '</form>'.
                '</div>'.
            '</div>';
    }

?>