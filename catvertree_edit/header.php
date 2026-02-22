<!DOCTYPE html>
<html>
<head>
    <title>Cat System</title>

    <style>
    body {
        margin: 0;
        font-family: 'Segoe UI', sans-serif;
        background: linear-gradient(135deg, #ccfffb, #ccfffc);
    }

    .header {
    display: flex;
    justify-content: space-between;
    grid-template-columns: 1fr auto 1fr;
    align-items: center;
    padding: 15px 40px;
    background: linear-gradient(90deg, #4fc3f7, #29b6f6);
    color: white;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

    .header a {
        color: white;
        text-decoration: none;
        margin-left: 20px;
        font-weight: 500;
    }

    .header a:hover {
        opacity: 0.85;
    }

    .footer {
        text-align: center;
        padding: 15px;
        background: #008cb3;
        color: white;
        margin-top: 40px;
    }

    .container {
        padding: 30px;
        min-height: 70vh;
        background: white;
        margin: 30px auto;
        width: 90%;
        max-width: 1100px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        padding: 40px;
    }

    h1, h2 {
        text-align: center;
        padding: 15px;
        color: #036c8c;
    }

    .btn {
        display: inline-block;
        padding: 8px 18px;
        background: linear-gradient(45deg, #99f1ff, #02abc1);
        color: white;
        text-decoration: none;
        border-radius: 20px;
        border: none;
        cursor: pointer;
    }

    .btn:hover {
        opacity: 0.8;
    }
.cat-gallery {
    display: flex;
    justify-content: center;   
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
    margin: 20px 0;
    margin-top: 30px;
}

.cat-img {
    width: 200px;      
    height: 200px;
    object-fit: cover; 
    border-radius: 15px; 
    box-shadow: 0 6px 15px rgba(0,0,0,0.15);
    transition: 0.3s;
}

.cat-img:hover {
    transform: scale(1.05);
}
.card {
    background: #f9f9f9;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.1);
    margin-bottom: 40px;
    text-align: center; 
}

.card-img {
    display: block;
    margin: 0 auto 20px auto;
    width: 350px;
    max-width: 100%;
    height: 350px;
    object-fit: cover;
    border-radius: 20px; 
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    transition: 0.3s;
}

.card-img:hover {
    transform: scale(1.04);
}

.card-content h2 {
    color: #036c8c;
}
</style>
</head>

<body>

<div class="header">
    <div><strong>🐱 CatSystem</strong></div>
</div>

<div class="container">