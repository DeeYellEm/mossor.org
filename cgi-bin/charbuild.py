#!/usr/bin/python

# Big Five Character NameGenerator
# Great for generating an NPC on the fly or as needed
# Includes names, gender as well as related Big 5 chracteristics, value and characterFlaws
# This generator was created by Laurel Mossor (and supported by Darrin Mossor)

# DEBUGGING STUFF
#import sys
#sys.stderr = sys.stdout

### IMPORT STUFF ###
#Necessary imports
import urllib2
import random
from random import randint

# Import modules for CGI handling
import cgi, cgitb

### Setup Vars ###

# Range for Big 5 generation
lowRange = 1
highRange = 10

##
# This section has a bunch of lists to draw from
##
genderList = ['Male', 'Female', 'Male', 'Female', 'Male', 'Female', 'Male', 'Female', 'Male', 'Female', 'Non-binary']

nameList = ['Fantasy', 'Modern-US']

namesMaleFantasy = ['Thazar-De Pisacar', 'Varis Meliamne', 'Corrin High-hill', 'Finnan High-hill', 'Ront', 'Cade Brushgather', 'Flint Balderk', 'Thokk', 'Urhur Pashar', 'Kairon', 'Heskan Daardendrian', 'Randal Domine', 'Keth', 'Gorstag Dundragon', 'Finnan Tosscobble', 'Urth Wan', 'Madislak Nemetsk', 'Kairon', 'Theren Xiloscient', 'Iados', 'Roondar Ningel', 'Roscoc Thorngage', 'Roondar Ningel', 'Leucis', 'Damakos', 'Erky Timbers', 'Dench', 'Roscoc Brushgather', 'Brocc Daergel', 'Tarhun Linxakasendalor', 'Balasar Fenkenkabradon', 'Romero Sum', 'Kairon', 'Holg', 'Dimble Scheppen', 'Laucian Amastacia', 'Mhurren', 'Dench', 'Lyle Tosscobble', 'Lindal Leagallow', 'Quarion Murnyethara', 'Fargrim Frostbeard', 'Akmenos', 'Romero Sepret', 'Iados', 'Evendur Stayanoga', 'Hadarai Lao', 'Traubon Strakeln', 'Fodel Lackman', 'Shamash Kepeshkmolik', 'Ront', 'Shamash Kerrhylon', 'Kairon', 'Mordai', 'Dimble Ningel', 'Tharivol Liadon', 'Hadarai Nemetsk', 'Wrenn Daergel', 'Quarion Holimion', 'Shamash Kimbatuul', 'Aseir Hahpet', 'Galinndan Galanodel', 'Mehmen Tallstag', 'Pandjed Nemmonis', 'Nadarr Nemmonis', 'Garret Tosscobble', 'Mumed Lao', 'Kosef Ling', 'Lyle Goodbarrel', 'An Nemetsk', 'Alton Thorngage', 'Varis Siannodel', 'Meng Lackman', 'Keth', 'Chen Marsk', 'Lyle Goodbarrel', 'Soveliss Galanodel', 'Kairon', 'Reed Hilltopple', 'Morthos', 'Gardain Battlehammer', 'Henk', 'Erevan Amakiir', 'Shump', 'Orryn Ningel', 'Reed Brushgather', 'Umbero Stormwind', 'Urhur Uuthrakt', 'Erky Timbers', 'Shedinn Drachedandion', 'Perrin Underbough', 'Ekemon', 'Rangrim Brawnanvil', 'Sindri Nackle', 'Alberich Torunn', 'Corrin Brushgather', 'Urth Windrivver', 'Torinn Kerrhylon', 'Fai Wan', 'Frug Scheppen', 'Boddynock Daergel', 'Theren Xiloscient', 'Zook Folkor', 'Bardeid Nathandem', 'Adran Galanodel', 'Keth', 'Alvyn Timbers', 'Ront', 'Umbero Ramondo', 'Gardain Torunn', 'Perrin High-hill', 'Romero Stormwind', 'Corrin Underbough', 'Quarion Galanodel', 'Einkil Lutgehr', 'Fodel Pisacar', 'Eldon Hilltopple', 'Ulfgar Dankil', 'Erevan Windrivver', 'On Domine', 'Pelaios', 'Theren Ilphelkiir', 'Darrak Fireforge', 'Ghesh Norixius', 'Ander Tealeaf']

namesFemaleFantasy = ['Euphemia High-hill', 'Loopmottin Beren', 'Duvamil Scheppen', 'Ea', 'Artin Rumnaheim', 'Oda Murnig', 'Tessele Nemetsk', 'Torbera Loderr', 'Shaena Hilltopple', 'Neega', 'Baggi', 'Raiann Fenkenkabradon', 'Thava Yarjerit', 'Kara Pin', 'Nedda Greenbottle', 'Sariel Amakiir', 'Baggi', 'Ellywick Nackle', 'Trym Hilltopple', 'Kallista', 'Falkrunn Balderk', 'Sutha', 'Luisa Ulmokina', 'Imzel Amblecrown', 'Damaia', 'Amber Brawnanvil', 'Caramip Turen', 'Quelenna Meliamne', 'Falkrunn Ironfist', 'Anastrianna Liadon', 'Kansif', 'Phelaia', 'Zanna Beren', 'Sannl Torunn', 'Shautha', 'Lureene Greycastle', 'Biri Myastan', 'Daar Nemmons', 'Rowan Dundrgon', 'Nulara Kung', 'Leshanna Sinnodel', 'Imzel Shemo', 'Audhild Lutehr', 'Criella', 'Oda Raulnor', 'Felosial Amstacia', 'Nemeia', 'Sora Prexijndilin', 'Kallista', 'Nissa Ninge', 'Jia Agosto', 'Duvamil Garick', 'Umara Fezim', 'Makaria', 'Trym Greenbttle', 'Portia Thorgage', 'Andry Tosscbble', 'Caelynn Piscar', 'Nulara Ulmoina', 'Shaena Goodarrel', 'Immith Nemesk', 'Volen', 'Nedda High-ill', 'Harann Kerrylon', 'Shava Meliane', 'Shamil Schepen', 'Eldeth Rumnheim', 'Nemeia', 'Tana Mei', 'Naivara Sianodel', 'Gunnloda Unart', 'Bai Mostana', 'Dona Windriver', 'Waywocket Grrick', 'Trym High-hll', 'Anakis', 'Nemeia', 'Ownka', 'Seraphina Bushgather', 'Jelenneth Hlimion', 'Lorilla Turn', 'Esvele Pisaar', 'Akta', 'Finellen Unart', 'Kethra Nathndem', 'Jheri Clethinthiallor', 'Kerri Falon', 'Riswynn Tornn', 'Kansif', 'Sutha', 'Bardryn Lodrr', 'Amafrey Marvaldi', 'Jalana Nemesk', 'Damaia', 'Kansif', 'Andraste Lidon', 'Lorilla Nacle', 'Artin Lutger', 'Orianna', 'Hlin Fireforge']

namesMaleModern = ['Daniel', 'Nigel', 'Devon', 'Owen', 'Granville', 'Demetrius', 'Percy', 'Cesar', 'Jamey', 'Rolland', 'Gabriel', 'Quincy', 'Garfield', 'Sung', 'Dalton', 'Alexis', 'Dominick', 'Porfirio', 'Edwin', 'Nicolas', 'Raleigh', 'Travis', 'Rey', 'Willy', 'Jewell', 'Odis', 'Heriberto', 'Dewitt', 'Jeffrey', 'Damon', 'Sonny', 'Jamaal', 'Andre', 'Walker', 'Jame', 'Andres', 'Eugenio', 'Francis', 'Humberto', 'Isiah', 'Genaro', 'Leandro', 'Jess', 'Enrique', 'Chong', 'Jamison', 'Bennett', 'Kasey', 'Filiberto', 'Cole', 'Jayson', 'Bobby', 'Chance', 'Harrison', 'Jamie', 'Freeman', 'Markus', 'Gus', 'Dexter', 'Desmond', 'Michel', 'Mary', 'Stefan', 'Russel', 'Stevie', 'Carlo', 'Mack', 'Nestor', 'Reynaldo', 'Logan', 'Merrill', 'Santo', 'Noah', 'Andre', 'Bryce', 'Trey', 'Leland', 'Toney', 'Benedict', 'Antione', 'Jermaine', 'Delbert', 'Dewayne', 'Tyron', 'Cory', 'Jayson', 'Hal', 'Damien', 'Alfred', 'Edwardo', 'Otis', 'Antony', 'Homer', 'Sammy', 'Bernard', 'Wendell', 'Hobert', 'Michel', 'Milford', 'Kelly']

namesFemaleModern = ['Sadie', 'Josephine', 'Rachell', 'Joannie', 'Davina', 'Kristan', 'Elisabeth', 'Krista', 'Evangelina', 'Zelma', 'Kenia', 'Sherise', 'Nancey', 'Delois', 'Karey', 'Collene', 'Michiko', 'Cassi', 'Joette', 'Daria', 'Zenia', 'Barbera', 'Albertine', 'Yolande', 'Kari', 'Carylon', 'Charita', 'Lillie', 'Sharmaine', 'Jon', 'Celeste', 'Johna', 'Margarite', 'Latrina', 'Dorthy', 'Meridith', 'Zina', 'Lean', 'Queenie', 'Dann', 'Ela', 'Cecilia', 'Samantha', 'Katheryn', 'Cecile', 'Myrta', 'Lesley', 'Ammie', 'Celesta', 'Allyn', 'Aja', 'Jalisa', 'Eliz', 'Olinda', 'Tillie', 'Criselda', 'Joleen', 'Keila', 'Oscar', 'Sarita', 'Lura', 'Joelle', 'Carmelita', 'Vashti', 'Alycia', 'Rosalind', 'Shante', 'Misha', 'Macy', 'Genevie', 'Leigh', 'Krystle', 'Gerda', 'Margeret', 'Trula', 'Cierra', 'Eustolia', 'Corie', 'Chantell', 'Jeannetta', 'Codi', 'Heike', 'Hollie', 'Alesha', 'Catalina', 'Elly', 'Pinkie', 'Becki', 'Nam', 'Desiree', 'Georgetta', 'Judy', 'Classie', 'Jeanie', 'Brandie', 'Clarisa', 'Isabel', 'Kerri', 'Torrie', 'Geraldine']

personalValues = ['Acceptance', 'Accomplishment', 'Accountability', 'Accuracy', 'Achievement', 'Adaptability', 'Alertness', 'Altruism', 'Ambition', 'Amusement', 'Assertiveness', 'Attentiveness', 'Awareness', 'Balance', 'Beauty', 'Boldness', 'Bravery', 'Brilliance', 'Calm', 'Candor', 'Capable', 'Certainty', 'Challenge', 'Charity', 'Cleanliness', 'Clever', 'Comfort', 'Commitment', 'Common sense', 'Communication', 'Community', 'Compassion', 'Competence', 'Concentration', 'Confidence', 'Connection', 'Consciousness', 'Consistency', 'Contentment', 'Contribution', 'Self-Control', 'Conviction', 'Cooperation', 'Courage', 'Courtesy', 'Creation', 'Creativity', 'Credibility', 'Curiosity', 'Decisive', 'Decisiveness', 'Dedication', 'Dependability', 'Determination', 'Development', 'Devotion', 'Dignity', 'Discipline', 'Discovery', 'Drive', 'Effectiveness', 'Efficiency', 'Empathy', 'Empower', 'Endurance', 'Energy', 'Enjoyment', 'Enthusiasm', 'Equality', 'Ethical', 'Excellence', 'Experience', 'Exploration', 'Expressive', 'Fairness', 'Family', 'Fame', 'Fearless', 'Feelings', 'Ferocious', 'Fidelity', 'Focus', 'Foresight', 'Fortitude', 'Freedom', 'Friendship', 'Fun', 'Generosity', 'Genius', 'Giving', 'Goodness', 'Grace', 'Greatness', 'Growth', 'Happiness', 'Hard work', 'Harmony', 'Health', 'Honesty', 'Honor', 'Hope', 'Humility', 'Imagination', 'Improvement', 'Independence', 'Individuality', 'Innovation', 'Insight', 'Inspiring', 'Integrity', 'Intelligence', 'Intensity', 'Intuition', 'Irreverence', 'Joy', 'Justice', 'Kindness', 'Knowledge', 'Lawful', 'Leadership', 'Learning', 'Liberty', 'Logic', 'Love', 'Loyalty', 'Mastery', 'Maturity', 'Meaning', 'Moderation', 'Motivation', 'Openness', 'Optimism', 'Order', 'Organization', 'Originality', 'Passion', 'Patience', 'Peace', 'Performance', 'Persistence', 'Playfulness', 'Poise', 'Potential', 'Power', 'Present', 'Productivity', 'Professionalism', 'Prosperity', 'Purpose', 'Quality', 'Realistic', 'Reason', 'Recreation', 'Self-reflection', 'Respect', 'Responsibility', 'Restraint', 'Results-oriented', 'Reverence', 'Rigor', 'Risk Taking', 'Satisfaction', 'Security', 'Self-reliance', 'Selfless', 'Sensitivity', 'Serenity', 'Service', 'Sharing', 'Significance', 'Silence', 'Simplicity', 'Sincerity', 'Skill', 'Skillfulness', 'Solitude', 'Spirit', 'Spirituality', 'Spontaneous', 'Stability', 'Status', 'Stewardship', 'Strength', 'Structure', 'Success', 'Supporting others', 'Surprise', 'Sustainability', 'Talent', 'Teamwork', 'Temperance', 'Gratitude', 'Thorough', 'Thoughtfulness', 'Timeliness', 'Tolerance', 'Toughness', 'Traditional', 'Tranquility', 'Transparency', 'Trust', 'Trustworthiness', 'Truth', 'Understanding', 'Uniqueness', 'Unity', 'Valor', 'Victory', 'Vigor', 'Vision', 'Vitality', 'Wealth', 'Welcoming', 'Winning', 'Wisdom', 'Wonder']

characterFlaws = ['Addict - One who is addicted, as to narcotics or a compulsive activity. (Gambling, drugs, sex, etc.)',
'Aimless - Devoid of direction or purpose.',
'Anxious - Full of mental distress or uneasiness because of fear of danger or misfortune, greatly worried, solicitous.',
'Apathetic - Having or showing little or no emotion, indifferent, impassive, cool, unfeeling.',
'Arrogant - Having or displaying a sense of overbearing self -worth or self -importance. Inclined to social exclusiveness and who rebuff the advances of people considered inferior. Snobbish.',
'Audacious - Recklessly bold in defiance of convention, propriety, law, or the like, insolent, brazen, disobedient.',
'Bigmouth - A loudmouthed or gossipy person.',
'Bigot - One who is strongly partial to one\'s own group, religion, race, or politics and is intolerant of those who differ.',
'Blunt - Characterized by directness in manner or speech, without subtlety or evasion. Frank, callous, insensitive, brusque.',
'Bold - In a bad sense, too forward, taking undue liberties, over assuming or confident, lacking proper modesty or restraint, rude, impudent. Abrupt, brazen, cheeky, brassy, audacious.',
'Callous - They are hardened to emotions, rarely showing any form of it in expression. Unfeeling. Cold.',
'Childish - Marked by or indicating a lack of maturity. Puerile.',
'Complex - An exaggerated or obsessive concern or fear.',
'Cruel - Mean to anyone or anything, without care or regard to consequences and feelings.',
'Cursed - A person who has befallen a prayer for evil or misfortune, placed under a spell, or borne into an evil circumstance, and suffers for it. Damned.',
'Dependent - Unable to exist, sustain oneself, or act appropriately or normally without the assistance or direction of another.',
'Deranged - Mentally decayed. Insane. Crazy. Mad. Psychotic.',
'Disloyal - Lacking loyalty. Unfaithful, perfidious, traitorous, treasonable',
'Disability - A disadvantage or deficiency, especially a physical or mental impairment that interferes with or prevents normal achievement in a particular area. (List the disability or disabilities. Ex: blind, missing limbs, deaf, color blind, no sense of smell, etc.)',
'Disorder - An ailment that affects the function of mind or body. (The following link is a list of disorders for you to explore.) Mental Disorder List.',
'Disturbed - Showing some or a few signs or symptoms of mental or emotional illness. Confused, disordered, neurotic, troubled.',
'Dubious - Fraught with uncertainty or doubt. Undecided, doubtful, unsure.',
'Egotistical - Characteristic of those having an inflated idea of their own importance. Boastful, pompous, selfish.',
'Envious - Showing extreme cupidity, painfully desirous of another\'s advantages, covetous, jealous.',
'Erratic - Deviating from the customary course in conduct or opinion.',
'Fanaticism - Fanatic outlook or behavior especially as exhibited by excessive enthusiasm, unreasoning zeal, or wild and extravagant notions on some subject.',
'Fickle - Characterized by erratic changeableness or instability, especially with regard to affections or attachments, capricious.',
'Fierce - Marked by extreme intensity of emotions or convictions, inclined to react violently, fervid, fierce loyalty, violent passions.',
'Finicky - Excessively particular or fastidious, difficult to please, fussy. Too much concerned with detail. Meticulous, fastidious, choosy, critical, picky, prissy, persnickety.',
'Fixation - In psychoanalytic theory, a strong attachment to a person or thing, especially such an attachment formed in childhood or infancy and manifested in immature or neurotic behavior that persists throughout life. Fetish, quirk, obsession, infatuation.',
'Flirt -To make playfully romantic or sexual overtures, behavior intended to arouse sexual interest. Minx. Tease.',
'Fools Love - A person who is always falling in love or believes they are in love, for the wrong person or even multiple people (usually one after another), and typically love at first sight. Star-crossed, ill -fated -love.',
'Frail - Physically weak and easily broken or damaged. Having delicate health, not robust. Feeble, breakable, sickly, dainty, brittle, fallible, imperfect, weak.',
'Fraudulent - Given to or using fraud, as a person, cheating, dishonest. Deceitful, deceptive, crooked, underhanded.',
'Gluttonous - Given to excess in consumption of especially food or drink. Voracious, ravenous, wolfish, piggish, insatiable.',
'Gruff -Brusque or stern in manner or appearance. Crusty, rough, surly.',
'Gullible - Will believe any information given, regardless of how valid or truthful it is, easily deceived or duped.',
'Habit - A rather revolting personal habit. (List habit - picks nose, spits tobacco everywhere, drools profusely, bad body odor, etc.)',
'Hard - A person who is difficult to deal with, manage, control, overcome, or understand. Hard emotions, hard hearted.',
'Hedonistic - Pursuit of or devotion to pleasure, especially to the pleasures of the senses.',
'Hoity-toity - Given to flights of fancy, capricious, frivolous. Prone to giddy behavior, flighty.',
'Humorless - The inability to find humor in things, and most certainly in themselves.',
'Hypocritical - One who is always contradicting their own beliefs, actions or sayings. A person who professes beliefs and opinions for others that he does not hold. Being a hypocrite.',
'Idealist - One whose conduct is influenced by ideals that often conflict with practical considerations. One, who is unrealistic and impractical, guided more by ideals than by practical considerations.',
'Idiotic - Marked by a lack of intelligence or care, foolish or careless.',
'Ignorant - Lacking knowledge or information as to a particular subject or fact. Showing or arising from a lack of education or knowledge.',
'Illiterate - Unable to read and write.',
'Impatient - Unable to wait patiently or tolerate delay, restless. Unable to endure irritation or opposition, intolerant.',
'Impious - Lacking piety and reverence for a god/gods and their followers.',
'Incompetent - Unable to execute tasks, no matter how the size or difficulty.',
'Indecisive - Characterized by lack of decision and firmness, especially under pressure.',
'Indifferent - The trait of lacking enthusiasm for or interest in things generally, remaining calm and seeming not to care, a casual lack of concern. Having or showing little or no interest in anything, languid, spiritless.',
'Infamy - Having an extremely bad reputation, public reproach, or strong condemnation as the result of a shameful, criminal, or outrageous act that affects how others view them.',
'Intolerant - Unwilling to tolerate difference of opinion and narrow -minded about cherished opinions.',
'Immature - Emotionally undeveloped, juvenile, childish.',
'Impish - Naughtily or annoyingly playful.',
'Judgmental - Inclined to make and form judgments, especially moral or personal ones, based on one\'s own opinions or impressions towards others/practices/groups/religions based on appearance, reputation, occupation, etc.',
'Klutz - Clumsy. Blunderer.',
'Lazy - Resistant to work or exertion. Disposed to idleness.',
'Lewd - Inclined to, characterized by, or inciting to lust or lechery. Lascivious. Obscene or indecent, as language or songs. Salacious.',
'Liar - Compulsively and purposefully tells false truths more often than not. A person who has lied or who lies repeatedly.',
'Lustful - Driven by lust, preoccupied with or exhibiting lustful desires.',
'Masochist - The deriving of sexual gratification, or the tendency to derive sexual gratification, from being physically or emotionally abused. A willingness or tendency to subject oneself to unpleasant or trying experiences.',
'Meddlesome - Intrusive in a meddling or offensive manner, given to meddling, interfering.',
'Meek - Evidencing little spirit or courage, overly submissive or compliant, humble in spirit or manner, suggesting retiring mildness or even cowed submissiveness.',
'Megalomaniac - A psycho pathological condition characterized by delusional fantasies of wealth, power, or omnipotence.',
'Miser - A stingy, avaricious person. Penny pincher, skinflint.',
'Misogynist - A person who hates, dislikes, mistrusts, or mistreats women. Sexist.',
'Misanthrope - A hater of humankind. Misanthropist.',
'Murderer - One guilty of murder, a person who unlawfully kills a human being. Killer, butchered, cutthroat.',
'Naive - Lacking worldly experience and understanding, simple and guileless, showing or characterized by a lack of sophistication and critical judgment.',
'Narcissist - A person who is overly self-involved, and often vain and selfish.',
'Nervous - Easily agitated or distressed, high -strung or jumpy.',
'Nonviolent - Abstaining from the use of violence.',
'Nosy - Given to prying into the affairs of others, snoopy. Offensively curious or inquisitive.',
'Obsessive - An unhealthy and compulsive preoccupation with something or someone.',
'Oppressive - A person of authority who subjects others to undue pressures, to keep down by severe and unjust use of force or authority.',
'Overambitious - Having a strong excessive desire for success or achievement.',
'Overemotional - Excessively or abnormally emotional. Sensitive about themselves and others, more so than the average person.',
'Overprotective - To protect too much, coddle.',
'Overconfident - Excessively confident, presumptuous.',
'Pacifist - Opposition to war or violence as a means of resolving disputes.',
'Paranoid - Exhibiting or characterized by extreme and irrational fear or distrust of others.',
'Peevish - Expressing fretfulness and discontent, or unjustifiable dissatisfaction. Cantankerous, cross, ill -tempered, testy, captious, discontented, crotchety, cranky, ornery.',
'Pest - One that pesters or annoys, with or without realizing it. Nuisance. Annoying. Nag.',
'Pessimist - A tendency to stress the negative or unfavorable or to take the gloomiest possible view.',
'Perfectionist - A propensity for being displeased with anything that is not perfect or does not meet extremely high standards.',
'Phobia - They have a severe form of fear when it comes to this one thing. (Dark, Spiders, Cats, tight spaces, etc.)',
'Practical - Level Headed, efficient, no-nonsense.',
'Precarious - Dependent on circumstances beyond one\'s control, uncertain, unstable, insecure.',
'Predictable - Easily seen through and assessable, where almost anyone can predict reactions and actions of said person by having met or known them even for a short time.',
'Proud - Filled with or showing excessive self -esteem, and will often shirk help from others for the sake of pride.',
'Rake - An immoral or dissolute person, acting without moral restraint, who defies established religious, social, expected precepts, a freethinker.',
'Rebellious - Defying or resisting some established authority, government, or tradition, insubordinate, inclined to rebel.',
'Reckless - Heedless, headstrong, foolhardy, unthinking boldness, wild carelessness and disregard for consequences.',
'Remorseless - Without remorse, merciless, pitiless, relentless.',
'Rigorous - Rigidly accurate, allowing no deviation from a standard, demanding strict attention to rules and procedures.',
'Sadist - The deriving of sexual gratification or the tendency to derive sexual gratification from inflicting pain or emotional abuse on others. Deriving of pleasure, or the tendency to derive pleasure, from cruelty.',
'Sarcastic - A subtle form of mockery in which an intended meaning is conveyed obliquely.',
'Sadomasochist - Both sadist and masochist combined.',
'Skeptic - One who instinctively or habitually doubts, questions, or disagrees with assertions or generally accepted conclusions.',
'Seducer - To lead others astray, as from duty, rectitude, or the like, corrupt. To attempt to lead or draw someone away, as from principles, faith, or allegiance.',
'Senile - Showing a decline or deterioration of physical strength or mental functioning, esp. short-term memory and alertness, as a result of old age or disease.',
'Scoundrel - A wicked or evil person, someone who does evil deliberately.',
'Selfish - Concerned chiefly or only with oneself.',
'Self-Martyr - One who purposely makes a great show of suffering in order to arouse sympathy from others, as a form of manipulation, and always for a selfish cause or reason.',
'Self-righteous - Piously sure of one\'s own righteousness. Moralistic. Exhibiting pious self-assurance. Holier-than-thou, sanctimonious.',
'Shallow - Lacking depth of intellect or knowledge, concerned only with what is obvious.',
'Smart Ass - Thinks they know it all, and in some ways they may, but they can be greatly annoying and difficult to deal with at times, especially in arguments.',
'Smug - Contentedly confident of one\'s ability, superiority, or correctness, complacent.',
'Sociopath - A person with a psychopathic personality whose behavior is antisocial, often criminal, and who lacks a sense of moral responsibility or social conscience.',
'Soft Hearted - Having softness or tenderness of heart that can lead them into trouble, susceptible of pity or other kindly affection. They cannot resist helping someone they see in trouble, suffering or in need, and often don\'t think of the repercussions or situation before doing so.',
'Solemn - Deeply earnest, serious, and sober.',
'Spineless - Lacking courage. Cowardly, wimp, lily -livered, gutless.',
'Spiteful - Showing malicious ill will and a desire to hurt, motivated by spite, vindictive person who will look for occasions for resentment. Vengeful.',
'Spoiled - Treated with excessive indulgence and pampering from earliest childhood, and has no notion of hard work, self-care or money management, coddled, pampered. Having the character or disposition harmed by pampering or over -solicitous attention.',
'Stubborn - Unreasonably, often perversely unyielding, bullheaded. Firmly resolved or determined, Resolute.',
'Squeamish - Excessively fastidious and easily disgusted.',
'Superstitious - An irrational belief arising from ignorance or fear from an irrational belief that an object, action, or circumstance not logically related to a course of events influences its outcome.',
'Tactless - Lacking or showing a lack of what is fitting and considerate in dealing with others.',
'Temperamental - Moody, irritable, or sensitive. Excitable, volatile, emotional.',
'Temptation - They have something that tempts, entices, or allures them, that is hard to resist. This could be anything, and can drive the character to do things of ill nature.',
'Theatrical - Having a flair for over dramatizing situations, doing things in a "big way" and love to be "center stage".',
'Tongue-tied - Speechless or confused in expression, as from shyness, embarrassment, or astonishment.',
'Timid -Tends to be shy and/or quiet, shrinking away from offering opinions or from strangers and newcomers, fearing confrontations and violence.',
'Troublemaker - Someone who deliberately stirs up trouble, intentionally or unintentionally.',
'Ugly - Very unattractive or unpleasant to look at, offensive to the sense of beauty, displeasing in appearance. Uncomely, unsightly, unlovely, homely.',
'Unlucky - Marked by or causing misfortune, ill-fated. Destined for misfortune, doomed.',
'Untrustworthy - Not worthy of trust or belief. Backstabber.',
'Unpredictable - Difficult to foretell or foresee, their actions are so chaotic it\'s impossible to know what they are going to do next.',
'User - A person who uses something or someone selfishly or unethically.',
'Vain - Holding or characterized by an unduly high opinion of their physical appearance. Lovers of themselves. Conceited, egotistic, narcissistic.',
'Weak-willed - Lacking willpower, strength of will to carry out one\'s decisions, wishes, or plans. Easily swayed.',
'Withdrawn - Not friendly or sociable. Aloof.',
'Whore - Harlot. A prostitute, a person who is considered sexually promiscuous, considered as having compromised principles for personal gain.',
'Zealot - An excessively zealous person, fanatic, radical, extremist.']

neuroticismNegList = ['gets angry easily',
'gets upset easily',
'changes mood a lot',
'gets easily agitated',
'can be stirred up easily',
'filled with doubts about many things',
'feels threatened easily',
'worries often about things',
'easily discouraged',
'becomes overwhelmed by events',
'afraid of many things']

neuroticismPosList = ['rarely gets irritated',
'keeps emotions under control',
'rarely loses composure',
'not easily annoyed',
'seldom feels blue',
'feels comfortable with themself',
'not easily embarrassed',
'self-assured',
'cool-headed',
'brave']

agreeablenessNegList = ['feels others\' emotions',
'inquires about others\' well-being',
'sympathizes with others\' feelings',
'takes an interest in other people\'s lives',
'likes to do things for others',
'respects authority',
'hates to seem pushy',
'avoids imposing will on others',
'rarely puts people under pressure']

agreeablenessPosList = ['not interested in other people\'s problems',
'can\'t be bothered with the needs of others',
'indifferent to the feelings of others',
'doesn\'t have a soft side',
'insults people',
'believes they are better than others',
'takes advantage of others',
'seeks conflict',
'loves a good fight',
'out for own personal gain']

conscientiousnessNegList = ['carries out plans',
'finishes what they start',
'gets things done quickly',
'likes order',
'keeps things tidy',
'likes to follow a schedule',
'wants everything to be "just right"',
'sees that rules are followed',
'wants every detail taken care of']

conscientiousnessPosList = ['wastes time',
'finds it difficult to get work done',
'often messes things up',
'doesn\'t put mind on the task at hand',
'postpone decisions',
'easily distracted',
'leaves belongings around',
'not bothered by messy people',
'not bothered by disorder',
'dislikes routine']

extraversionNegList = ['has a lot of fun',
'laughs a lot',
'takes charge',
'has a strong personality',
'knows how to captivate people',
'sees self as a good leader',
'can talk other into doing thing',
'is often the first to act' ]

extraversionPosList = ['rarely caught up in excitement',
'not very enthusiastic',
'not good at influencing others',
'waits for others to take the lead',
'holds back opinions',
'not assertive']

opennessNegList = ['has a rich vocabulary',
'things quickly',
'formulate ideas clearly',
'enjoys the beauty of nature',
'believes in the importance of art',
'loves to reflect on things',
'sees beauty in things that others might not notice',
'needs a creative outlet']

opennessPosList = ['learns things slowly',
'does not like poetry',
'seldom gets lost in thought',
'seldom daydreams',
'seldom notices emotional aspects of art/expression',
'concrete thinker']

# Source: https://oh-ay.tumblr.com/post/156850358813/list-of-gender-neutral-names-with-meanings-and
nonBinaryNames = ['Addison', 'Adina', 'Alby', 'Ally', 'Ash', 'Azra', 'Asa', 'Arin', 'Arlo', 'Avery', 'Alex', 'Arlen', 'Ambrose', 'Aspen', 'August', 'Blaine', 'Blake', 'Bryce', 'Brooklyn', 'Bradley', 'Bailey', 'Beck', 'Chyler', 'Cody', 'Charlie', 'Chris', 'Coby', 'Casey', 'Corin', 'Cameron', 'Colby', 'Dakota', 'Devon', 'Delaney', 'Drew', 'Denham', 'Dael', 'Danny', 'Ellis', 'Ellery', 'Evan', 'Emery', 'Eden', 'Ellison', 'Farron', 'Freddie', 'Frankie', 'Fynn', 'Finch', 'Flynn', 'Gene', 'Gale', 'Glade', 'Glen', 'Hollis', 'Harlow', 'Halley', 'Hadley', 'Isa', 'Ives', 'Iggy', 'Juniper', 'Jesse', 'Jo', 'Joey', 'Jordan', 'Jet', 'Kellam', 'Kelsey', 'Kendall', 'Kai', 'Logan', 'Leslie', 'Lee', 'Lane', 'Luca', 'Lirit', 'Lex', 'Lakota', 'Mattie', 'Morgan', 'Misha', 'Max', 'Mattise', 'Monroe', 'Newlyn', 'Noel', 'Nicky', 'Nat', 'Nova', 'Oakley', 'Oak', 'Perry', 'Piper', 'Pema', 'Puck', 'Parker', 'Quinn', 'Quinta', 'Reese', 'Rey', 'Reed', 'Rune', 'Rue', 'Rain', 'Riley', 'River', 'Rowan', 'Rory', 'Ronson', 'Sawyer', 'Stevie', 'Shiloh', 'Sage', 'Saxon', 'Sammy', 'Scout', 'Shane', 'Tex', 'Toni', 'Theo', 'Taylor', 'Tyne', 'Tyler', 'Terry', 'Umber', 'Wyatt', 'Willow', 'Wynne', 'Wren', 'Xen', 'Yael', 'Zen']

### PROCESSING ###

# Create instance of FieldStorage
form = cgi.FieldStorage()

# Get data from fields
if form.getvalue('dropdownGender'):
    genderOption = form.getvalue('dropdownGender')
else:
    genderOption = 'Random'

if (genderOption == 'Random'):
    gender = random.choice(genderList)
else:
    gender = genderOption

if form.getvalue('dropdownName'):
   nameOption = form.getvalue('dropdownName')
else:
    nameOption = 'Random'

if (nameOption == 'Random'):
    nameOption = random.choice(nameList)

if form.getvalue('verboseCheck'):
    verboseOption = form.getvalue('verboseCheck')
else:
    verboseOption = 'off'

### DEBUG OPTIONS for running as script
# This should be enabled if the script is run as a script (with input args).  Disabled if run as a cgi-bin script since the on page UI should set the options
#import argparse
#parser = argparse.ArgumentParser(description='Generate Characters based on the Big 5 Personality Model')
#parser.add_argument('-gender', action="store", dest="genderOption", choices=['Male', 'Female', 'Non-binary', 'Random'], default='Random', help='Gender Options', type=str)
#parser.add_argument('-name', action="store", dest="nameOption", choices=['Fantasy', 'Modern-US', 'None', 'Random'], default='Random', help='Types of names to be generated', type=str)
#args = parser.parse_args()


# Let's pick some things randomly
# gender - pick randomly from the list, unless overridden at the command line
#print ('TEST: [args.gender is ',args.genderOption,', args.name is ',args.nameOption,']')
# This should be enabled if the script is run as a script (with input args).  Disabled if run as a cgi-bin script since the on page UI should set the options
#if (args.genderOption == 'Random'):
#    gender = random.choice(genderList)
#else:
#    gender = args.genderOption
#
#if (args.nameOption == 'Random'):
#    nameOption = random.choice(nameList)
#elif ((args.nameOption == 'None') or (args.nameOption == '')):
#    nameOption = ''
#else:
#      nameOption = args.nameOption

print "Content-type:text/html\r\n\r\n"
print '<html>'
print '<head>'
print '<title>Big 5 - Character Generator</title>'
print '  <style type=\'text/css\'>'
print '    p, li {font-family: \'Roboto\', sans-serif; font-weight: 300; }'
print '  </style>'
print '</head>'
print '<body>'
#print '<h2>Character</h2>'



# These are the Big 5, choose each from 1-10 (lowRange to highRange)
neuroticism = randint(lowRange, highRange)
agreeableness = randint(lowRange, highRange)
conscientiousness = randint(lowRange, highRange)
extraversion = randint(lowRange, highRange)
openness = randint(lowRange, highRange)
# Additionally, chose three Values and a Character Flaw
personalValuesList = random.sample(personalValues, 3)
characterFlaw = random.choice(characterFlaws)

# One block each for each of the Big 5.  Based on the chosen value, choose a number of characteristics from the two related lists
neuroticismTraitsList = []
if (neuroticism == 1):
    neuroticismTraitsList = random.sample(neuroticismPosList, 3)
elif ((neuroticism == 2) or (neuroticism == 3)):
    neuroticismTraitsList = random.sample(neuroticismPosList, 2)
elif ((neuroticism == 4) or (neuroticism == 5)):
    neuroticismTraitsList = random.sample(neuroticismPosList, 1)
elif ((neuroticism == 6) or (neuroticism == 7)):
    neuroticismTraitsList = random.sample(neuroticismNegList, 1)
elif ((neuroticism == 8) or (neuroticism == 9)):
    neuroticismTraitsList = random.sample(neuroticismNegList, 2)
elif (neuroticism == 10):
    neuroticismTraitsList = random.sample(neuroticismNegList, 3)

agreeablenessTraitsList = []
if (agreeableness == 1):
    agreeablenessTraitsList = random.sample(agreeablenessPosList, 3)
elif ((agreeableness == 2) or (agreeableness == 3)):
    agreeablenessTraitsList = random.sample(agreeablenessPosList, 2)
elif ((agreeableness == 4) or (agreeableness == 5)):
    agreeablenessTraitsList = random.sample(agreeablenessPosList, 1)
elif ((agreeableness == 6) or (agreeableness == 7)):
    agreeablenessTraitsList = random.sample(agreeablenessNegList, 1)
elif ((agreeableness == 8) or (agreeableness == 9)):
    agreeablenessTraitsList = random.sample(agreeablenessNegList, 2)
elif (agreeableness == 10):
    agreeablenessTraitsList = random.sample(agreeablenessNegList, 3)

conscientiousnessTraitsList = []
if (conscientiousness == 1):
    conscientiousnessTraitsList = random.sample(conscientiousnessPosList, 3)
elif ((conscientiousness == 2) or (conscientiousness == 3)):
    conscientiousnessTraitsList = random.sample(conscientiousnessPosList, 2)
elif ((conscientiousness == 4) or (conscientiousness == 5)):
    conscientiousnessTraitsList = random.sample(conscientiousnessPosList, 1)
elif ((conscientiousness == 6) or (conscientiousness == 7)):
    conscientiousnessTraitsList = random.sample(conscientiousnessNegList, 1)
elif ((conscientiousness == 8) or (conscientiousness == 9)):
    conscientiousnessTraitsList = random.sample(conscientiousnessNegList, 2)
elif (conscientiousness == 10):
    conscientiousnessTraitsList = random.sample(conscientiousnessNegList, 3)

extraversionTraitsList = []
if (extraversion == 1):
    extraversionTraitsList = random.sample(extraversionPosList, 3)
elif ((extraversion == 2) or (extraversion == 3)):
    extraversionTraitsList = random.sample(extraversionPosList, 2)
elif ((extraversion == 4) or (extraversion == 5)):
    extraversionTraitsList = random.sample(extraversionPosList, 1)
elif ((extraversion == 6) or (extraversion == 7)):
    extraversionTraitsList = random.sample(extraversionNegList, 1)
elif ((extraversion == 8) or (extraversion == 9)):
    extraversionTraitsList = random.sample(extraversionNegList, 2)
elif (extraversion == 10):
    extraversionTraitsList = random.sample(extraversionNegList, 3)

opennessTraitsList = []
if (openness == 1):
    opennessTraitsList = random.sample(opennessPosList, 3)
elif ((openness == 2) or (openness == 3)):
    opennessTraitsList = random.sample(opennessPosList, 2)
elif ((openness == 4) or (openness == 5)):
    opennessTraitsList = random.sample(opennessPosList, 1)
elif ((openness == 6) or (openness == 7)):
    opennessTraitsList = random.sample(opennessNegList, 1)
elif ((openness == 8) or (openness == 9)):
    opennessTraitsList = random.sample(opennessNegList, 2)
elif (openness == 10):
    opennessTraitsList = random.sample(opennessNegList, 3)

# beginDebug - force some values for testing
#nameOption = "Modern-US"
#gender = "Male"
# endDebug

#Random Fantasy Names - https://api.genr8rs.com/Generator/Gaming/Rpg/NameGenerator?genr8rsUserId=1553621405.27845c9a619d43fbe&_sGenre=fantasy&_sRace=any&_sGender=male

if (nameOption == "Fantasy"):
    if (gender == "Male"):
        name = random.choice(namesMaleFantasy)
    if (gender == "Female"):
        name = random.choice(namesFemaleFantasy)
    if (gender == "Non-binary"):
        name = random.sample(nonBinaryNames,1)
        name = name[0]

#Random Census (Real) Names are fun - See: https://namey.muffinlabs.com/api.js
elif (nameOption == "Modern-US"):
    if (gender == "Male"):
        name = random.choice(namesMaleModern)
    if (gender == "Female"):
        name = random.choice(namesFemaleModern)
    if (gender == "Non-binary"):
        name = random.sample(nonBinaryNames,1)
        name = name[0]
else:
    name = '[nameless]'


if verboseOption == 'off':
    # Compact - no numbers

    print "<p><b>%s</b> (%s)</p>" % (name, gender)
    print "<ul>"
    print "  <li>%s</li>" % ((", ".join(map(str,neuroticismTraitsList))).capitalize() + ".")
    print "  <li>%s</li>" % ((", ".join(map(str,agreeablenessTraitsList))).capitalize() + ".")
    print "  <li>%s</li>" % ((", ".join(map(str,conscientiousnessTraitsList))).capitalize() + ".")
    print "  <li>%s</li>" % ((", ".join(map(str,extraversionTraitsList))).capitalize() + ".")
    print "  <li>%s</li>" % ((", ".join(map(str,opennessTraitsList))).capitalize() + ".")
    print "</ul>"
    print "<p><b>Values</b>: %s</p>" % (", ".join(map(str,personalValuesList)))  #join transforms the list to a str with a comma separator
    print "<p><b>Character</b>: %s</p>" % (characterFlaw)

#    print "<p>Name Option (%s)" % (nameOption)
#    print "<p>Gender Option (%s)" % (gender)
#    print "<p>verboseOption (%s)" % (verboseOption)

    print '</body>'
    print '</html>'
