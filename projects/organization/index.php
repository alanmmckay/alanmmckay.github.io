<?php

$normalize = '../../normalize.css';

$style = '../../style.css';

$canonical = 'https://alanmckay.blog/projects/organization/';

$title = 'Alan McKay | Teaching | Computer Organization';

$meta['title'] = 'Alan McKay | Computer Organization';

$meta['description'] = '';

$meta['url'] = 'https://alanmckay.blog/projects/organization/';

include('../../header.php');

?>
        <section id='writingsWrapper'>
            <section>
                <article>
                    <section class='info'>
                        <header>
                            <h2>Preface</h2>
                        </header>
                        <h3>Pedagogy: College Education and Computer Science</h3>
                        <p>
                            Upon concluding the first semester of grad-school, I was asked to take on a sole-responsibility role to teach Computer Organization during the summer semester. As someone who had only been in grad-school for five months, I took pride that I was offered the position. I must have impressed as a TA. Being a non-traditional student afforded me valuable life experience which contributed to confidence as both an individual and an instructor. My diverse background experience also lent well to being able to communicate and teach using a multitude of different approaches.
                        </p>

                        <p>
                            My brief stint as a PhD student has shown me that the fact the university is an R1 school likely also played a role in my selection - no tenured faculty member wanted to take on the task and a fresh grad student is low in the rung of production for what the school ultimately values - research.
                        </p>

                        <p>
                            Regardless of motive of selection, things aligned with my motives as a student. I did not pursue any of my degrees, (Master's included), for the sake of getting my name on a paper. I attended these educational institutions to learn and to satisfy my curiosity of the discipline. This curiosity extended to wanting to learn how to effectively teach the subject.
                        </p>

                        <p>
                            Computer Science is a hard discipline to learn. I pose that most have difficulty teaching the discipline. Frustratingly, most <b>professors</b> have difficulty teaching the discipline - Experts of the field! Why is this? Intuition built by my experiences has shown that most professors are post-doc researchers who are obligated to teach. As alluded above, their motives don't often align with quality instruction. To teach a subject is an annoyance that comes with the job. Anyone who has gone to college, regardless of discipline, will likely agree with this assertion whilst mentally (re)evaluating majority of their professors. Doubly so for those that are tenured.
                        </p>

                        <p>
                            The question needs to be asked of who is at a disadvantage through this environment? What type of student is at risk here? These questions are too general for the focus of this writing, but I invite the reader to linger and muse on them. I will make the following assertions based on my experiences which should also be considered:
                            <ul>
                                <li>
                                    In the domain of computer science, there are three different types of students:
                                    <ul>
                                        <li>
                                            There are those who are studying a different discipline who are required to take a CS course as a prerequisite.
                                        </li>
                                        <li>
                                            There are those who have heard jobs related to the field pay well, and thus are studying on the prospect of future paycheck.
                                        </li>
                                        <li>
                                            Finally, there are the individuals who are genuinely curious of the subject.
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    An individual can initially be one of the former two and eventually be molded to fit the later of the three categories.
                                </li>
                                <li>
                                    Students who are genuinely curious of the subject will succeed. The definition of success is that they will get a degree and they will have a solid and flexible intuition of the machinations of the discipline.
                                    <ul>
                                        <li>
                                            The students in the other categories will get just a degree.
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    Students applying for a a job related to the field of computer science will have a technical quiz during an interview. This is rare; I know of no other disciplines that exhibit this. A doctor who is applying for work at a practice does not have to recite information and procedure they learned as a pre-med student. A computer science student needs to memorize what they've learned in data structures, despite of the fact that as a software developer you have access to a wide range of resources to help solve problems.
                                    <ul>
                                        <li>
                                            The fact this is how things exist must be due to the fact that students of the above mentioned second category exist and need to be filtered.
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    No instructor, myself included, can wholly prepare an individual for these technical quizzes. It is up to the individual to take a vested interest in the subject - this involves taking it upon themselves to truly comprehend a lot of the core concepts that are a part of this discipline.
                                </li>
                            </ul>
                        </p>

                        <p>
                            The fact that technical quizzes exist in the interview stage implies that a lifetime of irreversible damage has been done within the instructional system. Some will say that instructors aren't doing a good enough job of filtering out those who don't do well enough. I will instead assert that instructors aren't doing a good enough job teaching the material to a wider range of individuals.
                        </p>

                        <hr>

                        <p>
                            Loops are easy. They're a concept taught early in the stage of programming. They are also super frustrating as a beginner; an esoteric construct that goes against the grain of normal human experience. This is said emphasizing the level of granularity required to convey that some <b>thing</b> needs to be <b>repeated</b>. I almost dropped out of community college because of loops. My instructor simply told me the surface facts of a loop and did not encourage any form of reflection. I was given a loop of a specific problem, the pieces that describe the condition of execution were highlighted, and it was noted that the body acted as the logic that needed to be repeated. There was no exploration of how to determine what belongs in the body and what doesn't; or how to fine-tune the condition of execution.
                        </p>

                        <p>
                            Loops are easy in the context of studying Computer Science. Due to the fact a loop is relatively easy, it becomes intuitive for anyone who has enough experience to be able to teach. It's difficult to teach an intuitive concept to someone who does not have that intuit. My approach has always been through analog. This begins with discussion of the various iterative happenings that may occur through life and then discussion of how to encode them. After this discussion, examples are given.
                        </p>

                        <p>
                            Once examples are given, I've always been keen to sharing alternatives to a given implementation of a loop. A for-loop absolutely should be taught in tandem with a while loop. This should occur with a light exposure to recursion. Various conditions of execution should be discussed here as well. Analog is not only given through context of every day living but also with respect to evaluating the loops themselves!
                        </p>
                        <hr>
                        <figure>
                            <code>
<pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:70vw;max-width:32em;padding-left:10px;max-height:250px'>
def sum_a(aList):
    total = 0
    for value in aList:
        total += value
    return total

def sum_b(aList):
    total = 0
    length = len(aList)
    for index in range(0,length):
        value = aList[index]
        total += value
    return total

def sum_c(aList):
    total = 0
    index = 0
    length = len(aList)
    while index &lt; length:
        value = aList[index]
        total = total + value
        index = index + 1
    return total

def sum_d(aList):
    listCopy = list(aList)
    total = 0
    length = len(listCopy)
    while length &gt; 0:
        value = listCopy.pop()
        total = total + value
        length = len(listCopy)
    return total

def sum_e(aList):
    listCopy = list(aList)
    total = 0
    while len(listCopy) &gt; 0:
        value = listCopy.pop()
        total = total + value
    return total

def sum_f(aList):
    total = sum(aList) #python's built-in sum function
    return total
</pre>
                            </code>
                            <figcaption>
                                A set of functions which take a list as an input and sums their values. Each function accomplishes the same task. This illustrates that there are many different approaches to solving a given problem - a notion that is not intuitive to one first experiencing the rigidity of programming.
                            </figcaption>
                        </figure>

                        <figure>
                            <code>
<pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:70vw;max-width:32em;padding-left:10px;max-height:250px'>
def sum_g(aList):
    return sum(alist)

def sum_h_helper(aList,index):
    length = len(aList)
    if index &gt;= length:
        return 0
    else:
        value = aList[index]
        return value + sum_h_helper(aList,index + 1)

def sum_h(aList):
    return sum_h_helper(aList,0)

def sum_i_helper(aList,index):
    length = len(aList)
    value = aList[index]
    if index &gt;= (length - 1):
        return value
    else:
        return value + sum_i_helper(aList,index + 1)

def sum_i(aList):
    if len(aList) &gt; 0:
        return sum_i_helper(aList,0)
    else:
        return 0

def sum_j_helper(aList,value):
    length = len(aList)
    if length &lt;= 0:
        return value
    else:
        new_value = aList.pop()
        return value + sum_j_helper(aList,new_value)

def sum_j(aList):
    listCopy = list(aList)
    if len(listCopy) &gt; 0:
        value = listCopy.pop()
        return sum_j_helper(listCopy,value)
    else:
        return 0

def sum_k(aList):
    if len(aList) &lt;= 0:
        return 0
    else:
        value = aList[0]
        if len(aList) &lt;= 1:
            return value
        else:
            other_values = aList[1:]
            return value + sum_k(other_values)

def sum_l(aList):
    if len(aList) &lt;= 0:
        return 0
    elif len(aList) &lt;= 1:
        return aList[0]
    else:
        return aList[0] + sum_l(aList[1:])
</pre>
                            </code>
                            <figcaption>
                                Even more functions which take a list as an input and sums their values. This time leveraging the functional paradigm of programming.
                            </figcaption>
                        </figure>
                        <hr>
                        <p id='second-note-origin'>
                            The usage of analogous example shows that the same problem can have many solutions. This allows a student to view solutions through different perspectives. This abstracts the study to what it is - how to abstract the algorithm. It also encourages a student to think outside of the box and to be creative in their own solutions. This helps foster one of the most crucial traits of being <b>successful</b> within this study - being curious while thinking critically.<a href='#second-note'>**</a>
                        </p>

                        <p>
                            A student who isn't genuinely interested in the study is less likely to apply critical thought. They may have been boxed into a narrow view of the study where no interest is curated. This type of student is more likely to find solutions on stack overflow and not learn from them. This type of student is more likely to learn what little they need to from generative tools like Chat GPT.
                        </p>

                        <p>
                            At the end of day, regardless of which category a student belongs, they are paying good money for the education. They are taking a class to learn the subject involved. The goal of an educator should be to engage with the students' expectations and maximize the value of the experience. <i>Value of the experience</i> is subjective to each individual, but given the context of school being a <b>place to learn</b>, my efforts are focused on providing the value of knowing the subject. Within the example of teaching loops, I take extra effort in providing the value of knowing what a loop is and does by inviting a student to be a critical thinker.
                        </p>

                        <p>
                            What is it that a <b>paying student</b> seeks to learn by taking Computer Organization? Any student who is paying to be in the class is likely a Computer Science major. Many would describe it as a weed-out course that teaches a programming paradigm that is antiquated. A generic student may not be able to justify why it has this perception, but those who have a genuine interest will tell you that it's due to a combination of Moore's law and compiler optimization techniques.
                        </p>

                        <p>
                            To answer this question, post-doc researcher teaching the course will rattle off a set of objectives set in place by the institution, likely falling upon the course description provided by the university. They may say:
                            <blockquote>
                                By the end of the course, you will be able to explain how a computer works, from “bottom to top”: transistors to digital logic to assembly language (e.g., x86, MIPS) to the programming language (e.g., Javascript, Java, Python). To do so, you will uncover how data is represented and stored in digital computers. You will learn how to write programs in an assembly language made up of basic instructions (e.g., multiply two numbers, write a number to memory) that a computer can understand. You will learn how to construct and use the basic blocks of a computer processor: arithmetic, memories, I/O, and gates built using digital logic (circuits whose wires hold 1’s and 0’s). You will use design tools to build a CPU that runs assembly programs. Finally, you will analyze computer systems with respect to engineering metrics like cost and performance and discuss factors, such as data locality and parallelism, that affect these metrics. <cite> - UIowa.edu</cite>
                            </blockquote>
                            This course description was indeed the ultimate appeal for continuing my education from community college into university. Having learned how to program at a higher-level, I was interested in knowing what occurs close to the circuit; I wanted to learn the "1's and 0's," as it is said.
                        </p>

                        <p>
                            I do not believe the above course description does the class justice. This course brings together and synthesizes Data and Discrete Structures. Data Structures formally introduces the concept of data representation by exploring alternative implementations of algorithms that are commonly abstracted by higher-level programming languages. Discrete Structures provides the mathematical background to describe the actual representation of data as it exists within the logical circuitry. This synthesis is more than the sum of its parts. The propositional logic used to describe the circuitry is represented as a certain set of symbols which is then translated to the symbolic diagrams which compose the logical circuitry. The assembly languages translated to this circuitry alludes that there may exist any amount of layers to translate a problem represented in one language to another. This course implicitly informs any curious student that the algorithm is programming-language agnostic. Wholly understanding this course trivializes studying Theory of Computation; this course teaches a student a model of computation!
                        </p>

                        <p>
                            The context provided by this preface is exempt from the post-course report I've written for the university. The context provided by this preface hopefully conveys to the reader that I tried to maximize the value of of learning the subject to my students. The extra value was explicitly relayed to my students with an emphasis that what we are building a model of computation. This gives extra context to the student by pushing the course beyond the study of some antiquated paradigm.
                        </p>

                    <hr>
                    </section>
                    <header>
                        <h1>Teaching: Computer Organization</h1>
                    </header>
                    <p>
                        The following is the report I submitted to the university upon the conclusion of hosting Computer Organization as a sole-responsibility instructor.
                    </p>
                    <h2>CS:2630 - Context and Methodology</h2>
                    <p>
                        People tend to have the perception of Computer Organization being a difficult class involving a lot of grit. This perception typically dominates discussion about the topic. Emphasis on key concepts can help alleviate these points. Specifically, directly correlating concepts of this course to concepts of previous courses.
                    </p>

                    <p>
                        Personally, it was Computer Organization that cemented the idea that learning a new programming language need not be daunting. The data and functions described throughout this course ultimately represent the same functions and data described in the higher-level languages of courses prior. Knowing this, the primary focus while teaching this course was to emphasize this fact. The means of describing the data in machine language in addition to the propositional logic used to manipulate that data serve as the model of computation in which the higher-level languages are built. This theme was highlighted quite often. Hopefully this made the course less gritty as concepts were built up from propositional logic to logical gates, logical circuits, control units, and assembly.
                    </p>

                    <p id='first-note-origin'>
                        Recognizing this scaffolding does require familiarity with some higher-level language. To fully appreciate it, it also requires being comfortable<a href='#first-note'>*</a> with some higher-level language. This is based on my experience as an undergraduate student. Stepping into university, my context was being comfortable with a handful of high-level scripting languages for web development. One key observation during the onset of my university experience was noticing that, within various courses that followed the introductory programming course, a lot of students were still gripping with the core concept of learning how to program. This tended to prevent them from understanding and appreciating the primary concepts being taught in said courses. This is especially true in data structures.
                    </p>

                    <p>
                        The university of Iowa has an advantage over the university I attended in the fact that Data Structures is a prerequisite to Computer Organization, as opposed to a corequisite. The point made in the previous paragraph still holds true regardless of this fact. The advantage becomes apparent when looking over the lab assignments given during this session.
                    </p>

                    <p>
                        As indicated in the topic outline above, the first couple of weeks were spent discussing the representation of data. Something that stuck out to me in the (optional) textbook associated with this session is the following aside:
                        <blockquote>
                            For converting larger values between decimal and hexadecimal, it is best to let a computer or calculator do the work. There are numerous tools that can do this. One simple way is to use any of the standard search engines, with queries such as <br>
                            Convert 0xabcd to decimal <br>
                            Or <br>
                            123 in hex <br>
                        </blockquote>
                    </p>

                    <p>
                         It is amazing that this was suggested in such a textbook, especially one that is of “a programmer’s perspective.” Knowing this cheeky blurb existed, the first lab was one to practice and test the programming skills of the student. They were to implement the functions which perform the conversions indicated by the aside in some high-level language of their choice. It was made apparent to those given the assignment that not only were they being gauged on the correctness of the functions but their coding styles were also being gleaned. Additionally, it was stated that should they find and use a solution on stack-overflow or an alternative that taking such a measure likely was indicative of a lack of problem-solving skills. It was made apparent that not taking the time to shore up those skills, (through this lab), that this lack of skill will make the course more difficult as time progresses and as more difficult problems are presented; problems that will not be so easy to find using said sources.
                    </p>

                    <p>
                        Looking at the subsequent labs, one may surmise that the reason it may be difficult finding solutions would be on account of using both a relatively obscure assembly language, MARIE, and an oversaturation of programs solved in higher-level languages, as per the lab assignments pertaining to MIPS.
                    </p>

                    <p>
                         While the MARIE programs acted as a means for one to become comfortable coding assembly, (while also being able to track the control and flow of data within the architecture), the MIPS programs acted as the means to cement the idea that the data and functions discussed throughout this course are the very same as those described in other languages. As the first lab asked to represent the algorithm which was applied by pen and paper in earlier lecture assignments and as it was through lecture that various representations of both data and functions were explored, the MIPS labs asked to represent various algorithms that should have been learned through data structures. Each facet drawing heavily from prior courses, something that was emphasized during instruction.
                    </p>

                    <p>
                        The submission policy outlined in the syllabus is an indication that should a student not be solid in any of these fundamental areas they will have the opportunity to make it up. What is not shown in the syllabus is the test policy. The tests given were take-home tests where a few days were given to complete them. They were essentially glorified labs with less focus on a specific topic. The tests were designed in a manner where, should one be up to speed with the course, it should take one and a half to two hours to complete. Should one not be up to speed, then they will need to invest more time to complete the test; a last chance to put in the time and learn the topics covered.
                    </p>

                    <hr>

                    <p>
                         The following pages contain the syllabus, lecture assignments, and lab assignments in the order in which they were given, followed by the two tests. This was the first class I have taught. My initial intentions were to give smaller lecture assignments following each lecture. My intentions were to also give a lab assignment every week. It did not turn out this way. To anyone looking this over, think of more lecture assignments to give. If I am to teach this course again, I will be doing that. As for the lab assignments, time was better spent giving lecture, as opposed to dedicating work time for the labs. This course was taught during the summer session, and it is my opinion that prolonged lectures were too dense. I instead opted to give shorter lectures and shoring them up with a supplemental 20–30-minute follow-up video which retouched lecture concepts and provided more examples or contexts. Labs were kicked off during the last class day of the week where the students had the entire weekend to complete.
                    </p>

                    <p>
                        If there are any lingering questions, feel free to contact me.
                    </p>

                    <hr>

                    <p id='first-note' style='padding-left:3%;'>
                        <a href='#first-note-origin' style=''>*</a> What it means to be comfortable with a programming language deserves its own essay. I will leave it to your own judgement to decide what this means, or I will leave an open invitation to personal conversation on the matter.
                    </p>

                    <section class='info'>
                        <hr>
                        <h3>Concluding notes</h3>
                        <p>
                            There is hesitation releasing the assignments as described in the concluding paragraph the report. This is in part due to the ambiguity of the University's copyright policy as it is currently written: The University will not claim pedagogical related materials but any production expected of a given position can still be claimed. Their literature doesn't discuss the contradiction this poses.
                        </p>

                        <p>
                            As such, time will be needed to generalize these assignments. Once finished, they will be posted within this concluding section.
                        </p>

                        <hr>

                        <div style='padding-left:3%;'>
                            <p id='second-note'>
                                <a href='#second-note-origin'>**</a> Engaging material isn't the sole component of fostering the development and application of critical thought. An engaging instructor is also an important aspect. Effective communication requires feedback from all parties involved. As an instructor, I would seek input and feedback from students as individuals. This is difficult in the lecture setting, needing to be general enough to adhere to the class as a whole. This focus on individuality manifests whilst hosting labs or while engaging with the students who themselves engage with the instructor.
                            </p>

                            <p>
                                I had no experience programming in MIPS prior to this teaching assignment. The last time I implemented any involving algorithm in assembly was when I initially took this course three years prior. My studying of MIPs occurred one or two days prior to giving the lecture. Was it laziness that caused me to take this approach?
                            </p>

                            <p>
                                The answer to the above question is partially yes. This laziness was a convenience afforded by my comfort in learning something new within this domain. This comfort is on account of my ability to critically think. Learning a new language is made trivial by this critical thought and through my experiences abstracting other languages. This 'laziness' affords the following benefits to the students:
                                <ul>
                                    <li>
                                        Having a fresh take on a language highlights some non-intuitive concepts someone who is more experienced may take for granted. This allowed me to know to take the time to elaborate on something that another instructor may have glossed over.
                                    </li>

                                    <li>
                                        Being inexperienced in the nuances of a language provided opportunities for me to make an unexpected mistake! This provides opportunity for students to witness how <b>I</b> think critically by showing them how I walk through an unknown problem and apply my own problem-solving skills.
                                    </li>
                                </ul>
                            </p>

                            <p>
                                The second bullet point is so god-damn important that it warrants appalling language in a professional writing. As a student, there is nothing more frustrating than seeing an instructor blow through some coding problem like they are a higher-being. In reality, the instructor probably has the solution key written off to the side or just memorized. This usually isn't revealed to the student, which implicitly sets an unreasonable expectation of performance. I will make a conjecture that this facade contributes to a barrier of entry that many find daunting.
                            </p>

                            <p>
                                My lack of experience with MIPS made the course more engaging in a way that creates a sincere connection between myself and the class in general. Any act of engagement to address an individual would usually involve addressing the questions/concerns by the use of analog and nudging the individual towards the conclusion they seek. This was done by asking them a set of questions to help them make the correct conclusion on their own! I believe this helps an individual feel personal agency by abstractly exposing them to how to think critically. One of my favorite pieces of feedback through student evaluation has been, "He makes you think."
                            </p>
                            <hr>
                                <figure>
                                    <code>
<pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:70vw;max-width:50em;padding-left:10px;'>
01    # --- --- --- --- --- --- #
02    sum:
03    # Two arguments $a0 (memory address of list) and $a1 (length value of list)
04
05    li $s0  0         #total &lt;- 0
06    li $s1  0         #index &lt;- 0
07    li $s2  $a0       #point to the base address of the array
08
09    # ---
10    sum_loop_condition:
11
12    bge $s1 $a1 end_loop
13
14    mult $s2 $s1 4    #adjust index offset
15    add  $s2 $s2 $a0  #point to the next value of the array
16
17    lw $s2 0($s2)     #access the value within array
18
19    add $s0 $s0 $s2   #add value to the total
20
21    addi $s1 $s1 1    #increment index
22
23    j sum_loop_condition
24
25    # ---
26    end_loop:
27    move $v0 $s0      #place total into return register
28    jr $ra            #return to caller
29    # --- --- --- --- --- --- #
</pre>
                                </code>
                                <!--code>
<pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:70vw;max-width:32em;padding-left:10px;max-height:250px'>
01    CLEAR
02    LOAD LST_LOC
03    STORE I /store the above list location at the pointer i
04    INPUT_LOOP, INPUT /input is now in the AC
05    SKIPCOND 400
06    JUMP INPUT_LOOP_BODY
07    JUMP ADD_LOOP
08    INPUT_LOOP_BODY, STOREI I /placing what exists in the AC at the pointer labeled i
09    LOAD I
10    ADD ONE /moving the pointer forward by 1
11    STORE I
12    LOAD LEN
13    ADD ONE /incrementing the length of the list
14    STORE LEN
15    JUMP INPUT_LOOP /going back to top of input_loop
16    ADD_LOOP, CLEAR
17    LOAD LST_LOC /hex value of location of the list
18    STORE I /the current pointer into the list
19    LOAD LEN
20    SUBT ONE
21    STORE CTR /the control variable used to exit the loop
22    LOOP, LOAD CTR
23    SKIPCOND 000 /checking to see if contents of the AC is negative**!
24    JUMP BODY
25    JUMP END
26    BODY, LOAD SUM
27    ADDI I /add the list item the pointer is currently looking at
28    STORE SUM
29    LOAD I
30    ADD ONE /moving the pointer forward by one
31    STORE I
32    LOAD CTR
33    SUBT ONE /decreasing the control variable
34    STORE CTR
35    JUMP LOOP
36    END, LOAD SUM
37    OUTPUT
38    HALT
39    LST_LOC, HEX 02C
40    I, HEX 0 /pointer labeled i
41    LEN, DEC 0
42    CTR, DEC 1
43    SUM, DEC 0
44    ONE, DEC 1
</pre>
                                </code-->
                                <figcaption>
                                    Just another way to sum up an array of values.
                                </figcaption>
                            </figure>
                        </div>
                        <hr>
                    </section>
                </article>
                <nav>
                    <a href='../'>Back</a>
                </nav>
            </section>
        </section>
    </body>
</html>
