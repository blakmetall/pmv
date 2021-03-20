import React from 'react';
import ReactDOM from 'react-dom';
import PropTypes from 'prop-types';

const LanguageSwitcher = props => {
    const { label, spanishLabel, spanishUrl, englishLabel, englishUrl } = props;

    return (
        <div>
            <div className="dropdown">
                <i className="i-Globe text-muted header-icon" 
                    role="button" 
                    id="languageSwitcherBtn" 
                    data-toggle="dropdown"
                    aria-haspopup="true" 
                    aria-expanded="false"></i>

                <div className="dropdown-menu dropdown-menu-right" aria-labelledby="languageSwitcherBtn">
                    
                    <div className="dropdown-header">
                        <i className="i-Globe mr-1"></i> 
                       {label}
                    </div>

                    <a className="dropdown-item" href={spanishUrl}>
                        {spanishLabel}
                    </a>

                    <a className="dropdown-item" href={englishUrl}>
                        {englishLabel}
                    </a>
                </div>
            </div>
        </div>
    );
}

export default LanguageSwitcher;

LanguageSwitcher.propTypes = {
    label: PropTypes.string,
    spanishLabel: PropTypes.string,
    spanishUrl: PropTypes.string,
    englishLabel: PropTypes.string,
    englishUrl: PropTypes.string,
};

LanguageSwitcher.defaultTypes = {
    label: '',
    spanishLabel: '',
    spanishUrl: '',
    englishLabel: '',
    englishUrl: '',
};

$('.app-language-switcher').each( function() {
    const elem = $(this);

    ReactDOM.render(
        (
            <LanguageSwitcher 
                label={ elem.attr('label') } 
                spanishLabel={ elem.attr('spanishLabel') }
                spanishUrl={ elem.attr('spanishUrl') }
                englishLabel={ elem.attr('englishLabel') }
                englishUrl={ elem.attr('englishUrl') }
                />
        ), 
        elem[0]
    );
});