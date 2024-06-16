<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rate Product</title>
    <style>
        .star-rating {
            direction: rtl;
            unicode-bidi: bidi-override;
            font-size: 2em;
            display: flex;
            justify-content: left   ;
            margin: 20px 0;
        }

        .star-rating input {
            display: none;
        }

        .star-rating label {
            color: gray;
            cursor: pointer;
            padding: 0 5px;
        }

        .star-rating input:checked ~ label,
        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: gold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Rate Product</h1>
        <form action="/rate" method="post">
            @csrf
            <input type="hidden" name="transaction_id" id="transaction_id" value="{{ $transaction_id }}">
            <input type="hidden" name="product_id" id="product_id" value="{{ $product_id }}">
            
            <div class="form-group">
                <label for="rating">Rating (1-5):</label>
                <div class="star-rating">
                    <input type="radio" id="star5" name="rating" value="5" /><label for="star5">&#9733;</label>
                    <input type="radio" id="star4" name="rating" value="4" /><label for="star4">&#9733;</label>
                    <input type="radio" id="star3" name="rating" value="3" /><label for="star3">&#9733;</label>
                    <input type="radio" id="star2" name="rating" value="2" /><label for="star2">&#9733;</label>
                    <input type="radio" id="star1" name="rating" value="1" /><label for="star1">&#9733;</label>
                </div>
            </div>
            
            <div class="form-group">
                <label for="review">Review:</label>
                <textarea name="review" id="review" rows="5" required></textarea>
            </div>
            
            <button type="submit">Submit Review</button>
        </form>
    </div>

    <script>
        document.querySelectorAll('.star-rating input').forEach(input => {
            input.addEventListener('change', () => {
                const ratingValue = input.value;
                console.log(`Selected rating: ${ratingValue}`);
            });
        });
    </script>
</body>
</html>
