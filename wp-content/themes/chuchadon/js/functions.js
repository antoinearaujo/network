
/**
 * Enable tab support for dropdown menus.
 */
( function() {
	var container,
	menuRight,
	searchFields;
	
	// Add icon in all search fields.
	searchFields = document.getElementsByClassName( 'search-submit' );
	
	for ( var i = 0, len = searchFields.length; i < len; i++ ) {
		searchFields[i].insertAdjacentHTML( 'beforebegin', '<span class="search-icon genericon genericon-search" aria-hidden="true"></span>' );
	}
	
	// Main nagivation
	container = document.getElementById( 'menu-primary' );

	if ( container ) {
		
		var buttonMain = document.getElementById( 'nav-toggle' );
		var buttonMainSpan = document.getElementById( 'nav-toggle-span' );
		var buttonMainMenu = document.getElementById( 'nav-toggle-menu' );
		var navMain = responsiveNav( ".main-navigation", {    // Selector
			transition: 350,                                  // Integer: Speed of the transition, in milliseconds
			customToggle: "#nav-toggle",                      // Selector: Specify the ID of a custom toggle
			enableFocus: true,                                // Boolean: Do we use use 'focus' class in our nav elements
			enableDropdown: true,                             // Boolean: Do we use multi level dropdown
			openDropdown: screenReaderTexts.expandSubMenu,    // String: Label for opening sub menu
			closeDropdown: screenReaderTexts.collapseSubMenu, // String: Label for closing sub menu
			resizeMobile: function () {                       // Set ARIA for menu toggle button
				buttonMain.setAttribute( 'aria-controls', 'menu-primary' );
			},
			resizeDesktop: function () {                      // Remove ARIA from menu toggle button
				buttonMain.removeAttribute( 'aria-controls' );
			},
			open: function () {
				buttonMainSpan.setAttribute( 'class', 'genericon genericon-close' );
				buttonMainMenu.innerHTML = screenReaderTexts.collapseMenu;
			},
			close: function () {
				buttonMainSpan.setAttribute( 'class', 'genericon genericon-menu' );
				buttonMainMenu.innerHTML = screenReaderTexts.expandMenu;
			},
		});
		
		// Top Right menu. We need to add dropdown buttons and .focus to this separately.
		menuRight = document.getElementById( 'top-right-items' );
		
		if ( menuRight ) {
			
			// Get all the link elements within the right menu.
			linksRight = menuRight.getElementsByTagName( 'a' );
			subMenusRight = menuRight.getElementsByTagName( 'ul' );
		
			// Each time a menu link is focused or blurred call the function toggleFocusRight.
			for ( var i = 0, len = linksRight.length; i < len; i++ ) {
				linksRight[i].addEventListener( 'focus', toggleFocusRight, true );
				linksRight[i].addEventListener( 'blur', toggleFocusRight, true );
			}
		
			// Set menu items with submenus to aria-haspopup="true" for right menu.
			for ( var i = 0, len = subMenusRight.length; i < len; i++ ) {
				subMenusRight[i].parentNode.setAttribute( 'aria-haspopup', 'true' );
			}
			
		}
		
	}
	
	// Set variables.
	var topSearchForm        = document.getElementById( 'top-search-form' )
	var menuSocial           = document.getElementById( 'menu-social' );
	var sidebarHeaderWrapper = document.getElementById( 'sidebar-header-wrapper' );
	
	// Top search form
	if ( topSearchForm ) {
		var buttonSearch     = document.getElementById( 'top-search-form-toggle' );
		var buttonSearchSpan = document.getElementById( 'top-search-form-toggle-span' );
		var buttonSearchMenu = document.getElementById( 'top-search-form-toggle-menu' );
		var searchField      = topSearchForm.getElementsByTagName( 'input' )[0];
		var navSearch        = responsiveNav( ".top-search-form", { // Selector
			transition: 350,                         // Integer: Speed of the transition, in milliseconds
			customToggle: "#top-search-form-toggle", // Selector: Specify the ID of a custom toggle
			open: function () {
				buttonSearchSpan.setAttribute( 'class', 'genericon genericon-close' );
				buttonSearchMenu.innerHTML = screenReaderTexts.collapseSearch;
				if ( menuSocial ) {
					navSocial.close();
				}
				if ( sidebarHeaderWrapper ) {
					navHeader.close();
				}
				
				topSearchForm.style.visibility = "visible";
				
				setTimeout( function () {
					searchField.focus();
				}, 350 );
			},
			close: function () {
				buttonSearchSpan.setAttribute( 'class', 'genericon genericon-search' );
				buttonSearchMenu.innerHTML = screenReaderTexts.expandSearch;
				topSearchForm.style.visibility = "hidden";
			},
		});
	}
	
	// Social menu
	if ( menuSocial ) {
		var buttonSocial     = document.getElementById( 'social-nav-toggle' );
		var buttonSocialSpan = document.getElementById( 'social-nav-toggle-span' );
		var buttonSocialMenu = document.getElementById( 'social-nav-toggle-menu' );
		
		// Focusable vars.
		var focusMenuSocial = menuSocial.querySelectorAll( 'input, select, a, textarea, button, [tabindex]' );
		var focusFirst      = focusMenuSocial[0];
		var focusLast       = focusMenuSocial[focusMenuSocial.length - 1];

		var navSocial       = responsiveNav( ".social-navigation", { // Selector
			transition: 350,                    // Integer: Speed of the transition, in milliseconds
			customToggle: "#social-nav-toggle", // Selector: Specify the ID of a custom toggle
			resizeMobile: function () {         // Set ARIA for menu toggle button
				buttonSocial.setAttribute( 'aria-controls', 'menu-social' );
			},
			resizeDesktop: function () {        // Remove ARIA from menu toggle button
				buttonSocial.removeAttribute( 'aria-controls' );
			},
			open: function () {
				buttonSocialSpan.setAttribute( 'class', 'genericon genericon-close' );
				buttonSocialMenu.innerHTML = screenReaderTexts.collapseSocialMenu;
				if ( topSearchForm ) {
					navSearch.close();  // Close search.
				}
				if ( sidebarHeaderWrapper ) {
					navHeader.close();  // Close Nav.
				}
				
				menuSocial.style.visibility = "visible";
				
				setTimeout( function () {
					focusFirst.focus();
					document.addEventListener( 'keydown', checkKey, true ); // Check Tab and Shift+Tab clicks.
				}, 350 );
		
			},
			close: function () {
				buttonSocialSpan.setAttribute( 'class', 'genericon genericon-hierarchy' );
				buttonSocialMenu.innerHTML = screenReaderTexts.expandSocialMenu;
				menuSocial.style.visibility = "hidden";
				document.removeEventListener( 'keydown', checkKey, true );
			},
		});
	}
	
	// Header sidebar
	if ( sidebarHeaderWrapper ) {
		var buttonHeader     = document.getElementById( 'header-sidebar-toggle' );
		var buttonHeaderSpan = document.getElementById( 'header-sidebar-toggle-span' );
		var buttonHeaderMenu = document.getElementById( 'header-sidebar-toggle-menu' );
		
		// Focusable vars.
		var focusHeader      = sidebarHeaderWrapper.querySelectorAll( 'input, select, a, textarea, button, [tabindex]' );
		var focusHeaderFirst = focusHeader[0];
		var focusHeaderLast  = focusHeader[focusHeader.length - 1];
		
		var navHeader        = responsiveNav( ".sidebar-header-wrapper", { // Selector
			transition: 350,                        // Integer: Speed of the transition, in milliseconds
			customToggle: "#header-sidebar-toggle", // Selector: Specify the ID of a custom toggle
			resizeMobile: function () {             // Set ARIA for menu toggle button
				buttonHeader.setAttribute( 'aria-controls', 'sidebar-header' );
			},
			resizeDesktop: function () {            // Remove ARIA from menu toggle button
				buttonHeader.removeAttribute( 'aria-controls' );
			},
			open: function () {
				buttonHeaderSpan.setAttribute( 'class', 'genericon genericon-close' );
				buttonHeaderMenu.innerHTML = screenReaderTexts.collapseHeaderSidebar;
				if ( topSearchForm ) {
					navSearch.close();  // Close search.
				}
				if ( menuSocial ) {
					navSocial.close();
				}
				
				sidebarHeaderWrapper.style.visibility = "visible";
				
				setTimeout( function () {
					focusHeaderFirst.focus();
					document.addEventListener( 'keydown', checkKeyHeader, true ); // Check Tab and Shift+Tab clicks.
				}, 350 );
			},
			close: function () {
				buttonHeaderSpan.setAttribute( 'class', 'genericon genericon-ellipsis' );
				buttonHeaderMenu.innerHTML = screenReaderTexts.expandHeaderSidebar;
				window.scrollTo( 0, 0 );
				sidebarHeaderWrapper.style.visibility = "hidden";
				document.removeEventListener( 'keydown', checkKeyHeader, true );
			},
		});
	}
	 
	/**
	 * Sets or removes .focus class on an element. We need to do this for top right menu separately.
	 */
	function toggleFocusRight() {
		var self = this;

		// Move up through the ancestors of the current link until we hit .menu-items-right. That's the top right menu where we need to do this separately.
		while ( -1 === self.className.indexOf( 'menu-items-right' ) ) {

			// On li elements toggle the class .focus.
			if ( 'li' === self.tagName.toLowerCase() ) {
				if ( -1 !== self.className.indexOf( 'focus' ) ) {
					self.className = self.className.replace( ' focus', '' );
				} else {
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	}
	
	// Check Tabbing in Social menu.
	function checkKey( e ) {
		
		// Set focus back to social toggle button when tabbing the last focusable element.
		if ( ( e.key === 'Tab' || e.keyCode === 9 ) && e.target === focusLast ) {
			e.preventDefault();
			buttonSocial.focus();
		}
		
		// Set focus back to social toggle button when Shift+Tab the first focusable element.
		if ( ( e.key === 'Tab' || e.keyCode === 9 ) && e.shiftKey && e.target === focusFirst ) {
			e.preventDefault();
			buttonSocial.focus();
		}
		
	}
	
	// Check Tabbing in Header.
	function checkKeyHeader( e ) {
	
		// Set focus back to header toggle button when tabbing the last focusable element.
		if ( ( e.key === 'Tab' || e.keyCode === 9 ) && e.target === focusHeaderLast ) {
			e.preventDefault();
			buttonHeader.focus();
		}
		
		// Set focus back to header toggle button when Shift+Tab the first focusable element.
		if ( ( e.key === 'Tab' || e.keyCode === 9 ) && e.shiftKey && e.target === focusHeaderFirst ) {
			e.preventDefault();
			buttonHeader.focus();
		}
		
	}
	
	// Fix child menus for touch devices.
	function fixMenuTouchTaps( container ) {
		var touchStartFn,
		    parentLink = container.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

		if ( 'ontouchstart' in window ) {
			touchStartFn = function( e ) {
				var menuItem = this.parentNode;

				if ( ! menuItem.classList.contains( 'focus' ) ) {
					e.preventDefault();
					for( var i = 0; i < menuItem.parentNode.children.length; ++i ) {
						if ( menuItem === menuItem.parentNode.children[i] ) {
							continue;
						}
						menuItem.parentNode.children[i].classList.remove( 'focus' );
					}
					menuItem.classList.add( 'focus' );
				} else {
					menuItem.classList.remove( 'focus' );
				}
			};

			for ( var i = 0; i < parentLink.length; ++i ) {
				parentLink[i].addEventListener( 'touchstart', touchStartFn, false )
			}
		}
	}
	
	if ( container ) {
		fixMenuTouchTaps( container );
	}
	
} )();

/**
 * Skip link focus fix.
 */
( function() {
	var is_webkit = navigator.userAgent.toLowerCase().indexOf( 'webkit' ) > -1,
	    is_opera  = navigator.userAgent.toLowerCase().indexOf( 'opera' )  > -1,
	    is_ie     = navigator.userAgent.toLowerCase().indexOf( 'msie' )   > -1;

	if ( ( is_webkit || is_opera || is_ie ) && document.getElementById && window.addEventListener ) {
		window.addEventListener( 'hashchange', function() {
			var element = document.getElementById( location.hash.substring( 1 ) );

			if ( element ) {
				if ( ! /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) )
					element.tabIndex = -1;

				element.focus();
			}
		}, false );
	}
} )();
