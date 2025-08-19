from rubka import Robot
from rubka.keypad import ChatKeypadBuilder
from rubka.context import Message
bot = Robot('CDAEI0XYJMYJHVDBDLTYDBAXGNIWDDYNPWPJXFDSXUWUXJBBVZGPMTCXXRWJEWKR') # توکن بات رو بزار

main_keypad = (
	ChatKeypadBuilder()
	.row(ChatKeypadBuilder().button("1", "راهنما"))
	.row(ChatKeypadBuilder().button("2", "پشتیبانی"))
	.build()
)

@bot.on_message()
def handel(bot, message:Message):
	text = message.text.strip()
	session = message.session
	if text == "/start":
		session.clear()
		message.reply_keypad("درود وقتتون بخیر چطور میتونم کمکتون کنم؟", keypad=main_keypad)
		return
	
	if text == "شروع":
		session.clear()
		session = message.session
		message.reply_keypad("درود وقتتون بخیر چطور میتونم کمکتون کنم؟", keypad=main_keypad)
		return
		
	if text == "/شروع":
		session.clear()
		message.reply_keypad("درود وقتتون بخیر چطور میتونم کمکتون کنم؟", keypad=main_keypad)
		return
	
	if text == "start":
		session.clear()
		message.reply_keypad("درود وقتتون بخیر چطور میتونم کمکتون کنم؟", keypad=main_keypad)
		return
	
	if text == "راهنما":
		message.reply(
			"دستورات در چنل @managerbotguide قرار گرفته است"
		)
		return
	
	if text == "پشتیبانی":
		message.reply(
		"@managerbotguide")
		return
print("ربات در حال اجراست...")
bot.run()
print("ربات در حال اجراست...")