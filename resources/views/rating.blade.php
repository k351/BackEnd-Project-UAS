<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rate Product</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
         body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .star-rating {
            display: flex;
            justify-content: center;
            direction: rtl;
            unicode-bidi: bidi-override;
            font-size: 3em;
            margin-bottom: 20px;
        }
        .star-rating input {
            display: none;
        }
        .star-rating label {
            color: gray;
            cursor: pointer;
            padding: 0 5px;
        }
        .star-rating input:checked ~ label {
            color: gold;
        }
        .star-rating input:checked + label,
        .star-rating input:checked + label ~ label {
            color: gold;
        }
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: vertical;
            box-sizing: border-box;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Rate Product</h1>
        <form action="{{ route('rating.store') }}" method="post">
            @csrf
            <input type="hidden" name="transaction_id" id="transaction_id" value="{{ $transaction_id }}">
            <input type="hidden" name="product_id" id="product_id" value="{{ $product_id }}">

            <div class="form-group">
                <label for="rating" id="rating-label">Apa yang bikin kamu puas?</label>
                <div class="star-rating">
                    <input type="radio" id="star5" name="rating" value="5" /><label for="star5"><i class="fas fa-star"></i></label>
                    <input type="radio" id="star4" name="rating" value="4" /><label for="star4"><i class="fas fa-star"></i></label>
                    <input type="radio" id="star3" name="rating" value="3" /><label for="star3"><i class="fas fa-star"></i></label>
                    <input type="radio" id="star2" name="rating" value="2" /><label for="star2"><i class="fas fa-star"></i></label>
                    <input type="radio" id="star1" name="rating" value="1" /><label for="star1"><i class="fas fa-star"></i></label>
               
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
                <textarea name="review" id="review" rows="5" placeholder="Yuk, ceritain kepuasanmu tentang kualitas barang & pelayanan penjual."></textarea>
            </div>
            
            <button type="submit">Kirim</button>
        </form>
    </div>

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Star Rating</title>
</head>
<body>
    <div class="star-rating">
        <!-- Star rating inputs go here -->
    </div>
    <label id="rating-label"></label>
    <textarea id="review" placeholder="Tulis ulasan kamu di sini..."></textarea>

    <script>
        const ratingInputs = document.querySelectorAll('.star-rating input');
        const ratingLabel = document.getElementById('rating-label');
        const reviewTextarea = document.getElementById('review');

        ratingInputs.forEach(input => {
            input.addEventListener('change', () => {
                const ratingValue = input.value;
                console.log(`Selected rating: ${ratingValue}`);

                if (ratingValue === '1') {
                    ratingLabel.textContent = 'Apa yang bikin kamu kecewa?';
                    reviewTextarea.placeholder = 'Ceritain lebih lengkap apa yang bikin kamu tidak puas dan perlu ditingkatkan.';
                } 
                else if(ratingValue === '2') {
                    ratingLabel.textContent = 'Apa yang bikin kamu tidak puas?';
                    reviewTextarea.placeholder = 'Ceritain lebih lengkap apa yang bikin kamu tidak puas dan perlu ditingkatkan.';
                }
                else if(ratingValue === '3') {
                    ratingLabel.textContent = 'Apa yang bikin kamu kurang puas?';
                    reviewTextarea.placeholder = 'Kasih tahu apa yang kurang dan perlu ditingkatkan';
                }
                else {
                    ratingLabel.textContent = 'Apa yang bikin kamu puas?';
                    reviewTextarea.placeholder = 'Yuk, ceritain kepuasanmu tentang kualitas barang & pelayanan penjual.';
                }
            });
        });
    </script>
</body>
</html>
