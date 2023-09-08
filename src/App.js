import React from 'react';
import './styles.css'; // Import your CSS file
import facebookImg from './img/facebook.png'; // Import your image files
import twitterImg from './img/twitter.png';
import linkedinImg from './img/linkedin.png';
import instagramImg from './img/instagram.png';
import cv from './img/cv.pdf';
import img from './img/img.jpg';
import about from './img/about.png';
import laravel from './img/laravel.png';
import php from './img/php.png';
import react from './img/react.png';
import redux from './img/redux.png';
import sql from './img/sql-server.png';
import tailwind from './img/tailwind.png';
import bootstrap from './img/bootstrap.png';
import js from './img/js.png';
import css from './img/css-3.png';
import img2 from './img/img2.jpg';
import img3 from './img/img3.jpg';
import img4 from './img/img4.jpg';
import img5 from './img/img5.jpg';
import img6 from './img/img6.jpg';
import img7 from './img/img7.png';

import img5 from './img/img5.jpg';
import img6 from './img/img6.jpg';
import img7 from './img/img7.png';
function App() {
  return (
    <div>
      <nav className="navbar">
        <div className="logo"><a href='#home'>MESITE</a></div>
        <ul className="menu">
          <li><a href="#home">Home</a></li>
          <li><a href="#contectMe">Contact Me</a></li>
          <li><a href="#about">About Me</a></li>
          <li><a href="#projects">My Projects</a></li>
        </ul>
      </nav>

      <div className="main-content" id="home">
        <div className="about-section">
          <div className="about-details">
            <h2 className="my-name">Hi 👋, My Name is Roshdi Raed</h2>
            <p className="about-hero">Hello! I'm Roshdi Raed, a dedicated Full Stack Developer with three years of experience. Proficient in Laravel programming, React, and Bootstrap, I bring creative solutions to complex problems. Passionate about delivering robust and user-friendly web applications that exceed expectations.</p>
            <br />
            <div className="buttons">
              <button className="hire-button">Hire Me</button>
              <button className="contact-button">My Projects</button>
              <button className="cv-button"><a href={cv} download>My CV</a></button>
            </div>
          </div>
          <div className="social-media">
            <a href="#" className="social-button"><img src={facebookImg} alt="Facebook" /></a>
            <a href="#" className="social-button"><img src={twitterImg} alt="Twitter" /></a>
            <a href="#" className="social-button"><img src={linkedinImg} alt="LinkedIn" /></a>
            <a href="#" className="social-button"><img src={instagramImg} alt="Instagram" /></a>
          </div>
        </div>
        <div className="image-section">
          <div className="image-container">
            <img src={img} alt="Your Name" />
          </div>
        </div>
      </div>

      <div className="container" id="about">
        <div className="equal-height">
          <div className="image-container">
            <img src={about} alt="About" />
          </div>
          <div className="details-container">
            <h1>About Me</h1>
            <p>Hello! I'm Roshdi Raed, a dedicated Full Stack Developer with three years of experience. Proficient in Laravel programming, React, and Bootstrap, I bring creative solutions to complex problems. Passionate about delivering robust and user-friendly web applications that exceed expectations.</p>
            <br />
            <div className="social-media">
            <a href="#" className="social-button"><img src={facebookImg} alt="Facebook" /></a>
            <a href="#" className="social-button"><img src={twitterImg} alt="Twitter" /></a>
            <a href="#" className="social-button"><img src={linkedinImg} alt="LinkedIn" /></a>
            <a href="#" className="social-button"><img src={instagramImg} alt="Instagram" /></a>
          </div>
          </div>
        </div>
      </div>

      {/* Project section */}
      
      <div className="projects-container" id="projects">
        <h1 className="projects-title">My Projects</h1>
        <div className="project-cards">
          {/* Repeat for each project card */}
          <div className="project-card">
            <img src={img2} alt="Book 2" />
            <h2>Payment Store</h2>
            <p>Modern and convenient interface</p>
            <button className="pro-button">
              <a href={img2} download>Download</a>
            </button>
          </div>
          <div className="project-card">
            <img src={img3} alt="Book 2" />
            <h2>Payment Store</h2>
            <p>Modern and convenient interface</p>
            <button className="pro-button">
              <a href={img3} download>Download</a>
            </button>
          </div>
          <div className="project-card">
            <img src={img4} alt="Book 2" />
            <h2>Payment Store</h2>
            <p>Modern and convenient interface</p>
            <button className="pro-button">
              <a href={img4} download>Download</a>
            </button>
          </div>
          <div className="project-card">
            <img src={img5} alt="Book 2" />
            <h2>Payment Store</h2>
            <p>Modern and convenient interface</p>
            <button className="pro-button">
              <a href={img5} download>Download</a>
            </button>
          </div>
          <div className="project-card">
            <img src={img6} alt="Book 2" />
            <h2>Payment Store</h2>
            <p>Modern and convenient interface</p>
            <button className="pro-button">
              <a href={img6} download>Download</a>
            </button>
          </div>
          <div className="project-card">
            <img src={img7} alt="Book 2" />
            <h2>Payment Store</h2>
            <p>Modern and convenient interface</p>
            <button className="pro-button">
              <a href={img7} download>Download</a>
            </button>
          </div>
          
          {/* Repeat for more project cards */}
        </div>
      </div>

      {/* Skills section */}
      
      <div className="skills-container">
        <h1 className="skills-title">* Skills *</h1>
        <div className="skills-content">
          {/* Repeat for each skills card */}
          <div className="skills-card">
            <div className="skills-image">
              <img src={laravel} alt="Laravel" />
            </div>
            <h3 className="skills-text">Laravel</h3>
          </div>
          
          <div className="skills-card">
            <div className="skills-image">
              <img src={php} alt="Laravel" />
            </div>
            <h3 className="skills-text">Php</h3>
          </div>
          
          <div className="skills-card">
            <div className="skills-image">
              <img src={react} alt="Laravel" />
            </div>
            <h3 className="skills-text">React</h3>
          </div>
          
          <div className="skills-card">
            <div className="skills-image">
              <img src={redux} alt="Laravel" />
            </div>
            <h3 className="skills-text">Redux</h3>
          </div>
          
          <div className="skills-card">
            <div className="skills-image">
              <img src={sql} alt="Laravel" />
            </div>
            <h3 className="skills-text">Sql Server</h3>
          </div>
          
          <div className="skills-card">
            <div className="skills-image">
              <img src={tailwind} alt="Laravel" />
            </div>
            <h3 className="skills-text">Tailwind</h3>
          </div>

          <div className="skills-card">
            <div className="skills-image">
              <img src={bootstrap} alt="Laravel" />
            </div>
            <h3 className="skills-text">Bootstrap</h3>
          </div>

          <div className="skills-card">
            <div className="skills-image">
              <img src={css} alt="Laravel" />
            </div>
            <h3 className="skills-text">Css</h3>
          </div>
          <div className="skills-card">
            <div className="skills-image">
              <img src={js} alt="Laravel" />
            </div>
            <h3 className="skills-text">js</h3>
          </div>
          
          {/* Repeat for more skills cards */}
        </div>
      </div>

      <div className="contact-us" id="contectMe">
        <h2>Contact Me</h2>
        <p>Fill out the form below to send us a message</p>
        <form>
          <label htmlFor="name">Name:</label>
          <input type="text" id="name" name="name" required />
          <label htmlFor="email">Email:</label>
          <input type="email" id="email" name="email" required />
          <label htmlFor="message">Message:</label>
          <textarea id="message" name="message" rows="5" required></textarea>
          <button type="submit">Submit</button>
        </form>
      </div>

      <footer>
        <p>© 2023 EMSITE. All rights reserved. | <a href="about.html">Privacy Policy</a> | <a href="about.html">Terms of Service</a></p>
      </footer>
    </div>
  );
}

export default App;
