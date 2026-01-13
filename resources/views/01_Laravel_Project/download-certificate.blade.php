<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Certificate of Completion</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9fafb; /* light gray background */
        }

        .certificate-wrapper {
            width: 100%;
            height: 100vh; /* full viewport height */
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .certificate-box {
            width: 800px; /* certificate width */
            height: 600px; /* certificate height */
            border: 6px solid #312e81; /* indigo border */
            background-color: #f3f4f6; /* gray background */
            padding: 60px 40px;
            text-align: center;
            box-sizing: border-box;
            position: relative;
        }

        .certificate-box h1 {
            font-size: 50px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            color: #1f2937; /* dark text */
        }

        .certificate-box h2 {
            font-size: 40px;
            margin-top: 40px;
            font-weight: bold;
            color: #111827;
        }

        .certificate-box h3 {
            font-size: 32px;
            margin-top: 20px;
            font-weight: 600;
            color: #374151;
        }

        .certificate-box p {
            font-size: 22px;
            margin-top: 15px;
            color: #4b5563;
        }

        .signature-section {
            position: absolute;
            bottom: 40px;
            left: 0;
            width: 100%;
            display: flex;
            justify-content: space-between;
            padding: 0 40px;
        }

        .signature {
            text-align: center;
        }

        .signature p {
            margin-top: 10px;
            font-size: 18px;
            color: #1f2937;
        }

        svg {
            width: 50px;
            height: 50px;
        }

        /* Optional: small watermark behind certificate */
        .watermark {
            position: absolute;
            font-size: 100px;
            color: rgba(203, 213, 225, 0.2); /* light gray */
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-30deg);
            pointer-events: none;
            user-select: none;
        }
    </style>
</head>
<body>
    <div class="certificate-wrapper">
        <div class="certificate-box">
            <div class="watermark">CERTIFIED</div>
            
            <h1>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="#1f1f1f">
                    <path d="m385-412 36-115-95-74h116l38-119 37 119h117l-95 74 35 115-94-71-95 71ZM244-40v-304q-45-47-64.5-103T160-560q0-136 92-228t228-92q136 0 228 92t92 228q0 57-19.5 113T716-344v304l-236-79-236 79Zm236-260q109 0 184.5-75.5T740-560q0-109-75.5-184.5T480-820q-109 0-184.5 75.5T220-560q0 109 75.5 184.5T480-300ZM304-124l176-55 176 55v-171q-40 29-86 42t-90 13q-44 0-90-13t-86-42v171Zm176-86Z"/>
                </svg>
                Certificate of Completion
            </h1>

            <p>This is to certify that</p>
            <h2>{{ $data['name'] }}</h2>
            <p>has successfully completed the</p>
            <h3>{{ $data['quiz'] }}</h3>
            <p>on {{ date('Y-m-d') }}</p>

            <div class="signature-section">
                <div class="signature">
                    <p>__________________</p>
                    <p>Instructor</p>
                </div>
                <div class="signature">
                    <p>__________________</p>
                    <p>Director</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>