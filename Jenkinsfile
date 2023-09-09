pipeline {
    agent {
        kubernetes {
            yaml '''
            spec:
                containers:
                - name: composer
                  image: composer
                  command:
                    - sleep
                  args:
                    - 99d
            '''
        }
    }
    stages {
        stage('Prepare') {
            steps {
                container('composer') {
                    sh 'apt-get install -y git libicu-dev zlib1g-dev libpng-dev libxslt-dev libzip-dev'
                    sh 'docker-php-ext-configure intl'
                    sh 'docker-php-ext-install intl bcmath gd xsl zip'
                    sh 'curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer'
                    sh 'RUN composer config --auth http-basic.repo.magento.com 9d48a380d9bbc8101cb2e47894cdffcb 8152b462329c2755b9dff42a1ea3f2ab'
                }
            }
        }
        stage('Install') {
            steps {
                container('composer') {
                    sh 'composer install'
                }
            }
        }
        stage('Evalute Version') {
            steps {
                container('composer') {
                    script {
                        env.CURRENT_COMPOSER_VERSION = sh(
                                script: 'composer config version',
                                returnStdout: true
                        ).trim()
                        env.NEW_COMPOSER_VERSION = sh(
                                script: 'echo ${CURRENT_COMPOSER_VERSION} | awk -F. -v OFS=. \'{$NF += 1 ; print}\'',
                                returnStdout: true
                        ).trim()
                    }
                }
            }
        }
        stage('Set Composer Version') {
            steps {
                container('composer') {
                    sh "composer config version ${NEW_COMPOSER_VERSION}"
                }
            }
        }
    }
}
