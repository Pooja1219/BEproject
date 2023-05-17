import smtplib
import random

def send_otp_email(recipient_email):
    # Generate a random OTP
    otp = random.randint(100000, 999999)

    # Email configuration
    sender_email = 'shreepooja.1912@gmail.com'
    smtp_server = 'smtp.gmail.com'
    smtp_port = 587
    username = 'shreepooja.1912@gmail.com'
    password = 'opwcahzkruufkzhi'

    # Subject and message for the email
    subject = 'OTP Verification'
    message = f'Your OTP is {otp}. Please enter this OTP to verify your email address.'

    try:
        # Connect to the SMTP server
        server = smtplib.SMTP(smtp_server, smtp_port)
        server.starttls()
        server.login(username, password)

        # Compose the email
        email = f'Subject: {subject}\n\n{message}'

        # Send the email
        server.sendmail(sender_email, recipient_email, email)
        print("OTP sent successfully.")

        # Close the connection
        server.quit()

        # Return the generated OTP
        return otp

    except smtplib.SMTPException as e:
        print(f"Failed to send OTP. Error: {str(e)}")

def verify_otp(otp, entered_otp):
    if otp == entered_otp:
        print("OTP verified successfully.")
    else:
        print("Invalid OTP.")

# Usage example
recipient_email = 'aryaarusasidharan10@gmail.com'
sent_otp = send_otp_email(recipient_email)

# Simulating OTP entry
entered_otp = int(input("Enter the OTP received via email: "))
verify_otp(sent_otp, entered_otp)