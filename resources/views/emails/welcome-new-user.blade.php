@component('mail::message')
![QR Code](https://baab.club/uploads/community/topic/img/1-2018-09-07-18-59-32-5b925a145a450.jpeg)

# Welcome , {{$username}}!
## Thank you for being a member of Baabclub.

## So , what is Baab.Club?
BaabClub is a new community build for international students mainly from Africa. Foreign students in China can find a lot of useful information here to solve your problems in the life and If you want to start some business between China and Africa , this website can help u .

For example, you can exchange old things here, rent your beloved house and get the goods here then send them to your country . Make friends with people who share the same aspirations in foreign countries. Broaden your relationship network or even look for a love 😂.

Also, u can ask questions here or ask for help if there is something inconvenient or difficult in your life. I'm sure BaabClub's enthusiastic volunteers or others will do what they can to help u.

Have a good time at BaabClub ！

## Some attention
We are committed to create a warm and harmonious community environment, not only convenient for others to live, but also let each of us harvest happiness. We hope you can also help us to build a beautiful community environment and think of this as a warm online home.

## Some Tips for you

1. First of all, you can go to the Personal Center page to modify your information, and replace a favorite avatar to let everyone know more about you.

2. Then,u can post in the community, participate in discussions, browse other topics or news, and express your views and opinions.

3. If you have any suggestions for our community or you want to create a new community section, you can post in the Manage & Suggest section. Thanks a lot for your support.

4. Also,if u are doing some small business or want others to contact you , you can post your Wechat personal QR code,wechat is a very popular Instant messaging app in China.

5. Be careful when you are trading with people in the community,If you can't tell if this person is trustworthy, you can contact our volunteers to assist you.


Volunteers' Phone number :18896657331 Tony.

u can scan the Wechat QR code to contact

![QR Code](https://baab.club/uploads/community/topic/img/1-2018-10-06-13-54-06-5bb84dfe77773.jpeg)

If you find a very serious Bug in the community, contact me from scan the wechat QR code.

![QR Code](https://baab.club/uploads/community/topic/img/1-2018-09-07-20-59-07-5b92761bf0a02.jpeg)

THx ! Have fun here!

@component('mail::button', ['url' => $link])
Go and Have a look
@endcomponent

Thanks,<br>
{{ config('app.name') }}

@component('mail::subcopy')
    If you’re having trouble clicking the "Go and Have a look" button, copy and paste the URL below
    into your web browser: [{{ $link }}]({{ $link }})
@endcomponent
@endcomponent
