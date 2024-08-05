<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #eeeeee;
        }
        .header h1 {
            font-size: 24px;
            color: #333333;
        }
        .content {
            padding: 20px;
            text-align: left;
        }
        .content h2 {
            color: #333333;
            font-size: 20px;
            margin-bottom: 10px;
        }
        .content p {
            color: #666666;
            font-size: 16px;
            line-height: 1.5;
            margin-bottom: 20px;
        }
        .content a {
            display: inline-block;
            padding: 10px 20px;
            color: #ffffff;
            background-color: #28a745;
            text-decoration: none;
            border-radius: 5px;
        }
        .footer {
            text-align: center;
            padding: 20px;
            border-top: 1px solid #eeeeee;
            color: #999999;
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Reader</h1>
    </div>
    <div class="content">
        <h2>Tài khoản của bạn đã bị khóa</h2>
        <p>Xin chào {{ $name }},</p>
        <p>Chúng tôi xin thông báo rằng tài khoản của bạn đã bị khóa. Bạn sẽ không thể tiếp tục sử dụng tài khoản của mình.</p>
        <p>Nếu bạn có bất kỳ câu hỏi nào, vui lòng liên hệ với bộ phận hỗ trợ của chúng tôi để được trợ giúp.</p>
        <a href="mailto:support@example.com">Liên hệ hỗ trợ</a>
    </div>
    <div class="footer">
        <p>&copy; 2024 Reader. All rights reserved.</p>
    </div>
</div>
</body>
</html>
