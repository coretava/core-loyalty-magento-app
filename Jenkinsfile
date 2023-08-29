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
        stage('Install') {
           steps {
               sh 'composer install'
           }
        }
        stage('Evalute Version') {
            steps {
                script {
                    env.CURRENT_COMPOSER_VERSION = sh (
                            script: 'composer config version',
                            returnStdout: true
                    ).trim()
                    env.NEW_COMPOSER_VERSION = sh (
                            script: 'echo ${CURRENT_COMPOSER_VERSION} | awk -F. -v OFS=. \'{$NF += 1 ; print}\'',
                            returnStdout: true
                    ).trim()
                }
            }
        }
        stage('Set Composer Version') {
           steps {
                sh "composer config version ${NEW_COMPOSER_VERSION}"
           }
        }
    }
}
