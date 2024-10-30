<!-- src/Templates/Dashboard/index.php -->
<head>

    <style>
        /* Full container background with overlay */
        .container-fluid {
            background-image: url('/img/business.jpg'); /* Path to the background image */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
            color: #ffffff;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0; /* Remove extra padding */
            margin: 0; /* Remove extra margin */
        }

        /* Dark overlay to improve text readability */
        .container-fluid::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6); /* Semi-transparent black overlay */
            z-index: 1;
        }

        /* Main content styling */
        .content-wrapper {
            position: relative;
            z-index: 2; /* Ensures content appears above overlay */
            max-width: 800px;
            text-align: left;
            padding: 2rem;
            color: #ffffff;
            background: transparent; /* Transparent background */
        }

        /* Typography improvements */
        .content-wrapper h1 {
            font-size: 6rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .content-wrapper h3 {
            font-size: 4rem;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }

        .content-wrapper p {
            font-size: 1.2rem;
            line-height: 1.5;
            margin-bottom: 1.5rem;
        }

        /* Button styling */
        .content-wrapper .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin: 0.5rem;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: bold;
            color: #ffffff;
            background-color: #4c67a1; /* Soft blue color for buttons */
            border-radius: 5px;
            text-decoration: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s, transform 0.3s;
            white-space: normal;
            width: auto;
        }

        /* Button hover effect */
        .content-wrapper .button:hover {
            background-color: #5a78b4;
            transform: translateY(-2px);
        }
    </style>
</head>

<div class="container-fluid">
    <div class="content-wrapper">
        <!-- Main content -->
        <h1 style="color: white;">About Nathan's Business</h1>
        <h4 style="color: white;">Nathan’s business specialises in B2B projects. We collaborate with business partners and contractors to deliver exceptional results. Join us to make an impact together!</h4>

        <h3 style="color: white;">Register as a Business Partner or Contractor</h3>
        <h4 style="color: white;">Interested in partnering with us? Please register below:</h4>


        <ul style="list-style-type: none; padding: 0;">
            <li><?= $this->Html->link(__('Register as a Contractor'), ['controller' => 'Contractors', 'action' => 'add'], ['class' => 'button']) ?></li>
            <li><?= $this->Html->link(__('Register as an Organisation'), ['controller' => 'Organisations', 'action' => 'add'], ['class' => 'button']) ?></li>
            <li><?= $this->Html->link(__('Contact Us'), ['controller' => 'Contact', 'action' => 'add'], ['class' => 'button']) ?></li>
        </ul>
    </div>
</div>
