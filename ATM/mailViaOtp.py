# Import the necessary libraries
import sys
import smtplib
import random

# Set up the email account credentials
email_address = "shreepooja.1912@gmail.com"  # replace with your email address
email_password = "opwcahzkruufkzhi"  # replace with your email password

# Set up the message to send
to_email_address = sys.argv[1]  # replace with the recipient's email address
otp = random.randint(100000, 999999)  
print(otp)# generate a 6-digit OTP
otpFinal = otp
subject = "Your One-Time Password"
message = f"Dear user,\n\nYour OTP is: {otpFinal}\n\nBest regards,\nThe team"

# Set up the SMTP server
smtp_server = "smtp.gmail.com"
smtp_port = 587

# Start the SMTP server and login to the email account
server = smtplib.SMTP(smtp_server, smtp_port)
server.starttls()
server.login(email_address, email_password)

# Send the message
server.sendmail(email_address, to_email_address, f"Subject: {subject}\n\n{message}")

# Quit the SMTP server
server.quit()


# Prompt the user to enter the OTP
user_otp = input("Enter the OTP received via email: ")

# Verify the OTP
