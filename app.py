from flask import Flask, request, send_from_directory, render_template_string
import os
from werkzeug.utils import secure_filename

app = Flask(__name__)

UPLOAD_FOLDER = 'uploads'
ALLOWED_EXTENSIONS = {'png', 'jpg', 'jpeg', 'gif', 'pdf', 'txt', 'mp4', 'mp3'}

app.config['UPLOAD_FOLDER'] = UPLOAD_FOLDER

if not os.path.exists(UPLOAD_FOLDER):
    os.makedirs(UPLOAD_FOLDER)

HTML = '''
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>آپلود فایل</title>
</head>
<body style="font-family: Tahoma, sans-serif; direction: rtl; padding: 20px;">
    <h1>آپلود فایل</h1>
    <form id="uploadForm" method="post" enctype="multipart/form-data">
        <input type="file" name="file" required />
        <button type="submit">آپلود</button>
    </form>
    {% if file_url %}
        <div style="margin-top: 20px; word-break: break-word;">
            فایل آپلود شد. لینک مستقیم: <a href="{{ file_url }}" target="_blank">{{ file_url }}</a>
        </div>
    {% endif %}
</body>
</html>
'''

def allowed_file(filename):
    return '.' in filename and filename.rsplit('.', 1)[1].lower() in ALLOWED_EXTENSIONS

@app.route('/', methods=['GET', 'POST'])
def upload_file():
    file_url = None
    if request.method == 'POST':
        if 'file' not in request.files:
            return 'فایلی ارسال نشده', 400
        file = request.files['file']
        if file.filename == '':
            return 'فایل انتخاب نشده', 400
        if file and allowed_file(file.filename):
            filename = secure_filename(file.filename)
            filepath = os.path.join(app.config['UPLOAD_FOLDER'], filename)
            file.save(filepath)
            file_url = f'/uploads/{filename}'
        else:
            return 'فرمت فایل مجاز نیست', 400
    return render_template_string(HTML, file_url=file_url)

@app.route('/uploads/<filename>')
def uploaded_file(filename):
    return send_from_directory(app.config['UPLOAD_FOLDER'], filename)

if __name__ == '__main__':
    app.run(debug=True)
